<?php

declare(strict_types=1);
/**
 * This file is part of maliboot module.
 *
 * @link     https://github.com/maliboot
 */
namespace Module\Medium\Infra\Repository;

use Hyperf\Di\Annotation\Inject;
use MaliBoot\Cola\Infra\AbstractCommonDBRepository;
use Module\Medium\Client\Constant\MediumCloudServerType;
use Module\Medium\Infra\DataObject\MediumCloudServerDO;
use Module\Medium\Infra\Utils\Filesystem;
use Module\Medium\Infra\Utils\FilesystemFactory;
use Module\Medium\Infra\Utils\OssAdapterFactory;

/**
 * MediumCloudServerRepo
 */
class MediumCloudServerRepo extends AbstractCommonDBRepository
{
    #[Inject]
    protected FilesystemFactory $filesystemFactory;

    public function getByIdOrNo(int|string $server): ?MediumCloudServerDO
    {
        $where = is_int($server) ? ['id' => $server] : ['server_no' => $server];
        /** @var MediumCloudServerDO|null $cloudServer */
        $cloudServer = $this->getByWhere($where);
        if (empty($cloudServer)) {
            return null;
        }
        return $cloudServer;
    }

    public function getFilesystem(MediumCloudServerDO $server): ?Filesystem
    {
        return match ($server->getType(0)) {
            MediumCloudServerType::OSS->value => $this->filesystemFactory->getByOptions('oss', [
                'storage' => [
                    'oss' => [
                        'driver' => OssAdapterFactory::class,
                        'accessId' => $server->getOssAccessId(''),
                        'accessSecret' => $server->getOssAccessSecret(''),
                        'bucket' => $server->getOssBucket(''),
                        'endpoint' => $server->getOssEndpoint(''),
                        ]
                    ]
                ]
            ),
            default => null,
        };
    }
}