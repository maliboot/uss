<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */

namespace Cases;

use Exception;
use Hyperf\Testing\TestCase;
use Module\Medium\Infra\Repository\FileRepo;

/**
 * @internal
 * @coversNothing
 */
class FileTest extends TestCase
{
    protected FileRepo $fileRepo;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->fileRepo = new FileRepo();
    }

    public function testUploadAppend()
    {
        try {
            $stream = fopen('php://memory', 'rw+');
            fwrite($stream, 'abc');
            rewind($stream);
            $this->fileRepo->uploadAppend(1, 'stone/foo-append.txt', $stream);
            $this->assertTrue(true);
        }catch (\Exception $e) {
            dump($e);
            $this->fail();
        }
    }

    public function testMultipartUploadInit()
    {
        try {
            $upload = $this->fileRepo->multipartUploadInit(1, 'stone/foo-multipart-upload.txt');
            dump($upload);
            $this->assertTrue(true);
        }catch (\Exception $e) {
            dump($e);
            $this->fail();
        }
    }

    public function testMultipartUploadPart()
    {
        // 1abc = 900150983CD24FB0D6963F7D28E17F72
        // 2def = 4ED9407630EB1000C0F6B63842DEFA7D
        // 3ghi = 826BBC5D0522F5F20A1DA4B60FA8C871
        $content = 'abc';
        $uploadId = 'CD87E008A3954FDDB1563F9599D1A514';
        $partNum = 1;
        try {
            $tag = $this->fileRepo->multipartUploadPart(1, 'stone/foo-multipart-upload.txt', $uploadId, $partNum, $content);
            dump($tag);
            $this->assertTrue(true);
        }catch (\Exception $e) {
            dump($e);
            $this->fail();
        }
    }

    public function testMultipartUploadComplete()
    {
        $uploadId = 'CD87E008A3954FDDB1563F9599D1A514';
        try {
            $this->fileRepo->multipartUploadComplete(1, 'stone/foo-multipart-upload.txt', $uploadId);
            $this->assertTrue(true);
        }catch (\Exception $e) {
            dump($e);
            $this->fail();
        }
    }

    public function testMultipartUploadListParts()
    {
        $uploadId = 'CD87E008A3954FDDB1563F9599D1A514';
        try {
            $parts = $this->fileRepo->multipartUploadListParts(1, 'stone/foo-multipart-upload.txt', $uploadId);
            dump($parts);
            $this->assertTrue(true);
        }catch (\Exception $e) {
            dump($e);
            $this->fail();
        }
    }

    public function testMultipartUploadAbort()
    {
        $uploadId = 'CD87E008A3954FDDB1563F9599D1A514';
        try {
            $this->fileRepo->multipartUploadAbort(1, 'stone/foo-multipart-upload.txt', $uploadId);
            $this->assertTrue(true);
        }catch (\Exception $e) {
            dump($e);
            $this->fail();
        }
    }

    public function testTemporaryUrl()
    {
        try {
            $url = $this->fileRepo->temporaryUrl(1, 'stone/send_test.jpeg', 3600 * 24);
            dump($url);
            $this->assertTrue(true);
        }catch (\Exception $e) {
            dump($e);
            $this->fail();
        }
    }

    public function testMultipartUploadAll()
    {
        $path = 'stone/foo-multipart-upload-all.jpg';
        $uploadFile = '/tmp/test/stone.jpg';
        try {
            $uploadId = $this->fileRepo->multipartUploadInit(1, $path);
            dump(sprintf('[%s]分页任务初始化成功:[%s]', $path, $uploadId));
            $i = 0;
            $bufferSize = 1024 * 1024;
            $uploadFileHandler = fopen($uploadFile, 'r+');
            while (! feof($uploadFileHandler)) {
                if (false === $buffer = fread($uploadFileHandler, $bufferSize)) {
                    throw new Exception('读取失败');
                }
                ++$i;
                $tag = $this->fileRepo->multipartUploadPart(1, $path, $uploadId, $i, $buffer);
                dump([sprintf('[%d]分页上传成功', $i), $tag]);
            }
            fclose($uploadFileHandler);

            $this->fileRepo->multipartUploadComplete(1, $path, $uploadId);
            $this->assertTrue(true);
        }catch (\Exception $e) {
            dump($e);
            $this->fail();
        }
    }
}
