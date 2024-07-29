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
use Hyperf\Testing\Client;
use Module\Medium\Infra\Repository\FileRepo;

/**
 * @internal
 * @coversNothing
 */
class MediumCloudServerTest extends TestCase
{
    protected FileRepo $fileRepo;

    protected Client $client;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->fileRepo = new FileRepo();
        $this->client = make(Client::class);
    }

    public function testHttpUpload()
    {
        $res = $this->client->request('POST','/admin/mediumCloudServer/upload', [
            'headers' => [],
            'form_params' => [
                'serverNo' => 'ts1722221630',
                'path' => 'stone/stone-http-test.jpg',
            ],
            'multipart' => [
                [
                    'name' => 'stone',
                    'contents' => fopen('/tmp/test/stone.jpg', 'r'),
                    'filename' => 'stone.jpg',
                ]
            ],
        ]);
        dump($res);
    }
}
