<?php

namespace Module\Medium\Infra\Utils;

use DateTimeInterface;
use Hyperf\Filesystem\Adapter\AliyunOssAdapterFactory;
use Hyperf\Flysystem\OSS\Adapter;
use League\Flysystem\Config;
use League\Flysystem\UnableToWriteFile;
use League\Flysystem\UrlGeneration\TemporaryUrlGenerator;
use OSS\Core\OssUtil;

class OssAdapterFactory extends AliyunOssAdapterFactory
{
    public function make(array $options): Adapter
    {
        return new class($options) extends Adapter implements MultipartUploadInterface, TemporaryUrlGenerator {
            public function writeStream(string $path, $contents, Config $config): void
            {
                if ($config->get('x-force-append') !== 'true') {
                    parent::writeStream($path, $contents, $config);
                    return;
                }

                // 自定义开始位置（文件存在时，强制追加）
                $initPos = 0;
                if ($this->fileExists($path)) {
                    $initPos = $this->fileSize($path)->fileSize();
                }

                $i = 0;
                $bufferSize = 1024 * 1024 * 2;
                while (! feof($contents)) {
                    if (false === $buffer = fread($contents, $bufferSize)) {
                        throw UnableToWriteFile::atLocation($path, 'fread failed');
                    }
                    $position = $i * $bufferSize + $initPos;
                    $this->client->appendObject($this->bucket, $path, $buffer, $position, $this->getOssOptions($config));
                    ++$i;
                    $initPos = 0;
                }
                fclose($contents);
            }

            public function multipartUploadInit(string $path, Config $config): string|null
            {
                return $this->client->initiateMultipartUpload($this->bucket, $path, $this->getOssOptions($config));
            }

            public function multipartUploadPart(string $path, string $uploadId, int $partNum, $contents, Config $config): string|null
            {
                $closeStream = false;
                if (is_string($contents) && !file_exists($contents)) {
                    $stream = fopen('php://temp', 'r+');
                    fwrite($stream, $contents);
                    rewind($stream);
                    $contents = $stream;
                    $closeStream = true;
                }

                $upOptions = array(
                    // 上传文件。
                    $this->client::OSS_FILE_UPLOAD => $contents,
                    // 设置分片号。
                    $this->client::OSS_PART_NUM => $partNum,
                    // 是否开启MD5校验，true为开启。
                    $this->client::OSS_CHECK_MD5 => false,
                );

                $tag = $this->client->uploadPart($this->bucket, $path, $uploadId, array_merge($this->getOssOptions($config), $upOptions));
                if ($closeStream) {
                    fclose($contents);
                }
                return $tag;
            }

            public function multipartUploadComplete(string $path, string $uploadId, Config $config): void
            {
                $options = $this->getOssOptions($config);
                $options['headers']['x-oss-complete-all'] = 'yes';
                $this->client->completeMultipartUpload($this->bucket, $path, $uploadId, null, $options);
            }

            public function multipartUploadListParts(string $path, string $uploadId, Config $config): array
            {
                return $this->client->listParts($this->bucket, $path, $uploadId, $this->getOssOptions($config))->getListPart();
            }

            public function multipartUploadAbort(string $path, string $uploadId, Config $config): void
            {
                $this->client->abortMultipartUpload($this->bucket, $path, $uploadId, $this->getOssOptions($config));
            }

            private function getOssOptions(Config $config): array
            {
                $options = [];
                if ($headers = $config->get('headers')) {
                    $options['headers'] = $headers;
                }

                if ($contentType = $config->get('Content-Type')) {
                    $options['Content-Type'] = $contentType;
                }

                if ($contentMd5 = $config->get('Content-Md5')) {
                    $options['Content-Md5'] = $contentMd5;
                    $options['checkmd5'] = false;
                }
                return $options;
            }

            public function temporaryUrl(string $path, \DateTimeInterface $expiresAt, Config $config): string
            {
                $timeout = $expiresAt->getTimestamp() - time();
                return $this->client->signUrl($this->bucket, $path, $timeout > 0 ? $timeout : 3600, 'GET', $this->getOssOptions($config));
            }
        };
    }
}