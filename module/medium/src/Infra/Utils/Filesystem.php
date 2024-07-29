<?php

namespace Module\Medium\Infra\Utils;

use League\Flysystem\Config;
use League\Flysystem\Filesystem as LeagueFilesystem;
use League\Flysystem\FilesystemAdapter;
use League\Flysystem\PathNormalizer;
use League\Flysystem\UrlGeneration\PublicUrlGenerator;
use League\Flysystem\UrlGeneration\TemporaryUrlGenerator;
use League\Flysystem\WhitespacePathNormalizer;

class Filesystem extends LeagueFilesystem
{
    private Config $config;
    private PathNormalizer $pathNormalizer;

    public function __construct(
        private FilesystemAdapter $adapter,
        array $config = [],
        ?PathNormalizer $pathNormalizer = null,
        private ?PublicUrlGenerator $publicUrlGenerator = null,
        private ?TemporaryUrlGenerator $temporaryUrlGenerator = null,
    ) {
        $this->config = new Config($config);
        $this->pathNormalizer = $pathNormalizer ?? new WhitespacePathNormalizer();
        parent::__construct($adapter, $this->config->toArray(), $this->pathNormalizer, $this->publicUrlGenerator, $this->temporaryUrlGenerator);
    }

    public function multipartUploadInit(string $path, array $config = []): string|null
    {
        if ($this->adapter instanceof MultipartUploadInterface) {
            return $this->adapter->multipartUploadInit($path, $this->config->extend($config));
        }
        return null;
    }

    public function multipartUploadPart(string $path, string $uploadId, int $partNum, $contents, array $config = []): string|null
    {
        if ($this->adapter instanceof MultipartUploadInterface) {
            return $this->adapter->multipartUploadPart($path, $uploadId, $partNum, $contents, $this->config->extend($config));
        }
        return null;
    }

    public function multipartUploadComplete(string $path, string $uploadId, array $config = []): void
    {
        if ($this->adapter instanceof MultipartUploadInterface) {
            $this->adapter->multipartUploadComplete($path, $uploadId, $this->config->extend($config));
        }
    }

    public function multipartUploadListParts(string $path, string $uploadId, array $config = []): array
    {
        if ($this->adapter instanceof MultipartUploadInterface) {
            return $this->adapter->multipartUploadListParts($path, $uploadId, $this->config->extend($config));
        }
        return [];
    }

    public function multipartUploadAbort(string $path, string $uploadId, array $config = []): void
    {
        if ($this->adapter instanceof MultipartUploadInterface) {
            $this->adapter->multipartUploadAbort($path, $uploadId, $this->config->extend($config));
        }
    }
}