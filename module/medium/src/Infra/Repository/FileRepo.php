<?php

namespace Module\Medium\Infra\Repository;

use Hyperf\Di\Annotation\Inject;
use League\Flysystem\FilesystemException;
use MaliBoot\Cola\Exception\InfraException;
use Module\Medium\Client\Constant\MediumErrorCode;
use Module\Medium\Infra\DataObject\MediumCloudServerDO;
use Module\Medium\Infra\Utils\Filesystem;

class FileRepo
{
    #[Inject]
    protected MediumCloudServerRepo $cloudServerRepo;

    /**
     * @param $contents ... 如果为资源，默认会关闭资源
     * @throws InfraException|FilesystemException ...
     */
    public function upload(int|string $server, string $path, $contents): void
    {
        $this->getFilesystem($server)->write($path, $contents);
    }

    /**
     * @param $contents ... 如果为资源，默认会关闭资源
     * @throws InfraException|FilesystemException ...
     */
    public function uploadAppend(int|string $server, string $path, $contents): void
    {
        $this->getFilesystem($server)->writeStream($path, $contents, ['x-force-append' => 'true']);
    }

    public function multipartUploadInit(int|string $server, string $path): string|null
    {
        return $this->getFilesystem($server)->multipartUploadInit($path);
    }

    /**
     * @param int|string $server ...
     * @param string $path ...
     * @param string $uploadId ...
     * @param int $partNum ...
     * @param $contents ... 1、除了最后一个分片，其它所有分片大小必须大于100kb；2、如果为资源，默认不会关闭资源
     * @return string|null ...
     * @throws InfraException ...
     */
    public function multipartUploadPart(int|string $server, string $path, string $uploadId, int $partNum, $contents): string|null
    {
        return $this->getFilesystem($server)->multipartUploadPart($path, $uploadId, $partNum, $contents);
    }

    public function multipartUploadComplete(int|string $server, string $path, string $uploadId): void
    {
        $this->getFilesystem($server)->multipartUploadComplete($path, $uploadId);
    }

    public function multipartUploadListParts(int|string $server, string $path, string $uploadId): array
    {
        return $this->getFilesystem($server)->multipartUploadListParts($path, $uploadId);
    }

    public function multipartUploadAbort(int|string $server, string $path, string $uploadId): void
    {
        $this->getFilesystem($server)->multipartUploadAbort($path, $uploadId);
    }

    public function temporaryUrl(int|string $server, string $path, ?int $timeout = null): string
    {
        $cloudServer = $this->cloudServerRepo->getByIdOrNo($server);
        if ($timeout === null) {
            $timeout = $cloudServer->getOssSignTimeout(0);
        }
        $expiredAt = (new \DateTime())->add(\DateInterval::createFromDateString(sprintf('%d seconds', $timeout)));
        return $this->getFilesystem($cloudServer)->temporaryUrl($path, $expiredAt);
    }

    /**
     * @throws InfraException ...
     */
    protected function getFilesystem(int|string|MediumCloudServerDO $server): Filesystem
    {
        if ($server instanceof MediumCloudServerDO) {
            $cloudServer = $server;
        } else {
            $cloudServer = $this->cloudServerRepo->getByIdOrNo($server);
        }
        $err = new InfraException(MediumErrorCode::SERVER_CLOUD_UNKNOWN->value, sprintf('serverId[%s]不存在', $server));
        if (empty($cloudServer)) {
            throw $err;
        }

        $fileSystem = $this->cloudServerRepo->getFilesystem($server);
        if (empty($fileSystem)) {
            throw new $err;
        }
        return $fileSystem;
    }
}