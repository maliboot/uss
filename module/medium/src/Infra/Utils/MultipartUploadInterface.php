<?php

namespace Module\Medium\Infra\Utils;

use League\Flysystem\Config;

interface MultipartUploadInterface
{
    public function multipartUploadInit(string $path, Config $config): string|null;

    public function multipartUploadPart(string $path, string $uploadId, int $partNum, $contents, Config $config): string|null;

    public function multipartUploadComplete(string $path, string $uploadId, Config $config): void;

    public function multipartUploadListParts(string $path, string $uploadId, Config $config): array;

    public function multipartUploadAbort(string $path, string $uploadId, Config $config): void;
}