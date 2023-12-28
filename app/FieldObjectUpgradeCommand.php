<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */

namespace App;

use Exception;
use Hyperf\Command\Annotation\Command;
use Hyperf\Command\Command as HyperfCommand;
use Hyperf\Stringable\Str;
use PhpParser\Node;
use PhpParser\Node\AttributeGroup;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Interface_;
use PhpParser\Node\Stmt\Property;
use PhpParser\Node\Stmt\Use_;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitorAbstract;
use PhpParser\ParserFactory;
use PhpParser\PrettyPrinter\Standard;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

#[Command(name: 'cola-up:field')]
class FieldObjectUpgradeCommand extends HyperfCommand
{
    /**
     * php bin/hyperf.php cola-up:field --dir module/bill.
     */
    public function configure()
    {
        parent::configure();
        $this->setDescription('将DTO、VO、Entity、DO升级为最新版本');
        $this->addOption('dir', 'D', InputOption::VALUE_OPTIONAL, 'Which dir will be rewrite.', 'module');
    }

    public function handle()
    {
        $dir = $this->input->getOption('dir');

        $dir = BASE_PATH . '/' . $dir;
        if (! is_dir($dir)) {
            $this->output->error('The dir does not exists.');
            return;
        }

        $finder = Finder::create()->files()
            ->ignoreVCS(true)
            ->path(['Client/Dto/Command', 'Client/Dto/Query', 'Client/ViewObject', 'Domain/Model', 'Infra/DataObject'])
            ->in($dir);

        foreach ($finder as $file) {
            /** @var SplFileInfo $file .. */
            $path = $file->getRealPath(); // \Symfony\Component\Finder\SplFileInfo
            $this->upgrade($path);
        }
    }

    protected function upgrade(string $filePath): void
    {
        $traverser = new NodeTraverser();
        $traverser->addVisitor(new class() extends NodeVisitorAbstract {
            public ?Node\Stmt\Namespace_ $namespace_ = null;

            public ?Class_ $class_ = null;

            public function beforeTraverse(array $nodes)
            {
                foreach ($nodes as $namespace) {
                    if ($namespace instanceof Node\Stmt\Declare_) {
                        continue;
                    }

                    if ($namespace instanceof Node\Stmt\Namespace_) {
                        $this->namespace_ = $namespace;
                        foreach ($namespace->stmts as $class) {
                            if ($class instanceof Class_) {
                                $this->class_ = $class;
                                break;
                            }
                        }
                    }
                }
                return null;
            }

            public function leaveNode(Node $node)
            {
                switch ($node) {
                    case $node instanceof Node\Stmt\Namespace_:
                        $this->visitNamespace($node);
                        break;
                    case $node instanceof Interface_:
                        // ...
                        break;
                    case $node instanceof Class_:
                        $this->visitClass($node);
                        break;
                    case $node instanceof ClassMethod:
                        $this->visitClassMethod($node);
                        break;
                    case $node instanceof Property:
                        $this->visitProperty($node);
                        break;
                }
                return null;
            }

            protected function visitNamespace(Node\Stmt\Namespace_ $namespace_): void
            {
                $newStmts = [];
                foreach ($namespace_->stmts as $stmt) {
                    if ($stmt instanceof Use_) {
                        $newUse = $this->visitUse($stmt);
                        $newUse !== null && $newStmts[] = $newUse;
                        continue;
                    }

                    $newStmts[] = $stmt;
                }
                $namespace_->stmts = $newStmts;

                // 添加use
                $insertUses = $this->insertUses();
                empty($insertUses) || $namespace_->stmts = [
                    ...$insertUses,
                    ...$namespace_->stmts,
                ];
            }

            /**
             * @return Use_[] ...
             */
            private function insertUses(): array
            {
                $data = [
                ];
                if (str_contains($this->class_->name->name, 'DO')) {
                    $data[] = new Use_([
                        new Node\Stmt\UseUse(new Name('MaliBoot\\Database\\Annotation\\Column')),
                    ]);
                } else {
                    $data[] = new Use_([
                        new Node\Stmt\UseUse(new Name('MaliBoot\\Lombok\\Annotation\\Field')),
                    ]);
                }
                return $data;
            }

            protected function visitUse(Use_ $use_): ?Use_
            {
                $useName = $use_->uses[0]->name->toString();
                $dbWillData = [
                ];

                // 删除
                if (isset($dbWillData['delete'][$useName])) {
                    return null;
                }

                // 修改
                if (isset($dbWillData['update'][$useName])) {
                    $use_->uses[0]->name = new Name($dbWillData['update'][$useName]);
                }

                return $use_;
            }

            protected function visitTraitUse(Node\Stmt\TraitUse $traitUse): ?Node\Stmt\TraitUse
            {
                return $traitUse;
            }

            protected function visitClassMethod(ClassMethod $classMethod): void {}

            protected function visitClassAttribute(Class_ $class_, AttributeGroup $attributeGroup): ?AttributeGroup
            {
                return $attributeGroup;
            }

            /**
             * @return array{string, 1}
             */
            private function getTraitUseNames(): array
            {
                $result = [];
                foreach ($this->class_->stmts as $item) {
                    if (! $item instanceof Node\Stmt\TraitUse) {
                        continue;
                    }
                    foreach ($item->traits as $traitName) {
                        $result[$traitName->toString()] = 1;
                    }
                }

                return $result;
            }

            protected function visitClass(Class_ $class_): void
            {
                $myProperties = $class_->getProperties();
                $fields = [];
                foreach ($myProperties as $myProperty) {
                    $myPropertyName = $myProperty->props[0]->name->name;
                    $fields[strtolower($myPropertyName)] = 1;
                }

                if (count($myProperties) != count($fields)) {
                    throw new Exception(sprintf('类属性名称可能重复，请选更正:%s,%s', $class_->namespacedName?->toString() ?? '', $class_->name->name));
                }

                $objectAttributes = [
                    'DataObject' => 1, 'DataTransferObject' => 1, 'ViewObject' => 1, 'AggregateRoot' => 1, 'ValueObject' => 1, 'Entity' => 1, 'Database' => 1,
                ];

                $filterAttributes = [];
                foreach ($class_->attrGroups as $attrGroup) {
                    $attrGroupName = $attrGroup->attrs[0]->name->toString();
                    isset($objectAttributes[$attrGroupName]) && $filterAttributes[] = $objectAttributes[$attrGroupName];
                }
                if (empty($filterAttributes)) {
                    return;
                }

                $newClassStmts = [];
                foreach ($class_->stmts as $classStmt) {
                    if ($classStmt instanceof Node\Stmt\TraitUse) {
                        $classTrait = $this->visitTraitUse($classStmt);
                        $classTrait !== null && $newClassStmts[] = $classTrait;
                        continue;
                    }
                    $newClassStmts[] = $classStmt;
                }
                $class_->stmts = $newClassStmts;
            }

            private function getAttributeArgValByName(AttributeGroup $attributeGroup, string $name): string
            {
                foreach ($attributeGroup->attrs[0]->args as $arg) {
                    if ($arg->name->toString() === $name) {
                        if ($arg->value instanceof Node\Expr\ClassConstFetch) {
                            return $arg->value->class->toString();
                        }
                        return $arg->value->value;
                    }
                }

                return '';
            }

            protected function visitProperty(Property $property): void
            {
                $newAttrGroups = [];
                foreach ($property->attrGroups as $attrGroup) {
                    $attributeName = $attrGroup->attrs[0]->name->toString();
                    if ($attributeName === 'Column' || $attributeName === 'Field') {
                        return;
                    }
                    if (! in_array($attributeName, ['ORM'])) {
                        $newAttrGroups[] = $attrGroup;
                    }
                }

                $attrName = str_contains($this->class_->name->name, 'DO') ? 'Column' : 'Field';
                $propertyName = $property->props[0]->name->name;
                if ($attrName === 'Column') {
                    $propertyName = Str::snake($propertyName);
                }
                $propertyTypeStr = str_replace('?', '', $property->type?->toString() ?? '');

                $propertyType = new Node\Scalar\String_($propertyTypeStr);
                if ($property->type instanceof Node\Name) {
                    $propertyType = new Node\Expr\ClassConstFetch(new Node\Name($propertyTypeStr), new Node\Identifier('class'));
                }

                $propertyDesc = rtrim(str_replace(['/', '*', "\n", ' '], '', $property->getDocComment()?->getText() ?? '...'), '.');
                $property->setAttribute('comments', null);

                $newAttrGroups[] = new AttributeGroup([new Node\Attribute(new Node\Name($attrName), [
                    new Node\Arg(
                        value: new Node\Scalar\String_($propertyName),
                        name: new Node\Identifier('name')
                    ),
                    new Node\Arg(
                        value: $propertyType,
                        name: new Node\Identifier('type')
                    ),
                    new Node\Arg(
                        value: new Node\Scalar\String_($propertyDesc),
                        name: new Node\Identifier('desc')
                    ),
                ])]);
                $property->attrGroups = $newAttrGroups;
            }
        });

        $parser = (new ParserFactory())->create(ParserFactory::PREFER_PHP7);
        try {
            $fileContent = file_get_contents($filePath);
            if (! str_contains($fileContent, '#[Field') && ! str_contains($fileContent, '#[Column')) {
                $stmts = $parser->parse($fileContent);
                $modifiedStmts = $traverser->traverse($stmts);
                $printer = new Standard();
                $newCode = $printer->prettyPrintFile($modifiedStmts);
                file_put_contents($filePath, $newCode);
                $this->info(sprintf('[%s]升级成功', $filePath));
            }
            // $stmts is an array of statement nodes
        } catch (Exception $e) {
            throw $e;
        }
    }
}
