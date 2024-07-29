<?php

namespace Module\Medium\Infra\Utils;

use Hyperf\Contract\ConfigInterface;
use Hyperf\Filesystem\Adapter\LocalAdapterFactory;
use Hyperf\Filesystem\FilesystemFactory as HyperfFilesystemFactory;
use Psr\Container\ContainerInterface;

class FilesystemFactory extends HyperfFilesystemFactory
{
    public function __construct(private ContainerInterface $container, private ConfigInterface $config)
    {
        parent::__construct($this->container, $this->config);
    }

    public function getByOptions($adapterName, array $options = []): Filesystem
    {
        $options = array_merge($this->config->get('file', [
            'default' => 'local',
            'storage' => [
                'local' => [
                    'driver' => LocalAdapterFactory::class,
                    'root' => BASE_PATH . '/runtime',
                ],
            ],
        ]), $options);
        $adapter = $this->getAdapter($options, $adapterName);
        return new Filesystem($adapter, $options['storage'][$adapterName] ?? []);
    }
}