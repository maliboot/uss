<?php

declare(strict_types=1);
/**
 * This file is part of maliboot module.
 *
 * @link     https://github.com/maliboot
 */
namespace Module\Medium\App\Executor\Admin;

use MaliBoot\Di\Annotation\Inject;
use MaliBoot\Cola\App\AbstractExecutor;
use MaliBoot\Cola\Annotation\AppService;
use Module\Medium\Client\Dto\MediumCloudServerCreateDTO;
use MaliBoot\Dto\IdVO;
use Module\Medium\Infra\Repository\MediumCloudServerRepo;

/**
 * MediumCloudServerCreateExe
 */
#[AppService]
class MediumCloudServerCreateExe extends AbstractExecutor
{
    #[Inject]
    protected MediumCloudServerRepo $mediumCloudServerRepo;

    public function execute(MediumCloudServerCreateDTO $dto): IdVO
    {
        $params = $dto->toArray();
        $result = $this->mediumCloudServerRepo->create($params);
        return (new IdVO())->setId($result);
    }
}