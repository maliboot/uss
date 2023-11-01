<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */
namespace MalibootTest\Cases;

use Exception;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Testing\TestCase;
use Uss\Message\App\Executor\Command\NotificationCmdExe;
use Uss\Message\Client\Dto\Command\NotificationCmd;

/**
 * @internal
 * @coversNothing
 */
class NotificationTest extends TestCase
{
    public function testJPush()
    {
        $res = false;
        try {
            $vo = \Hyperf\Support\make(NotificationCmdExe::class)->execute(NotificationCmd::of([
                'tplGroupUniqid' => 'tg654065f1625fc',
                'requestId' => md5((string) time()),
                'requestSource' => 'testUnit',
                'appPushTo' => json_encode(['18989898989']),
                'vars' => json_encode([
                    'company' => '北京马立合作社',
                    'money' => 325000,
                    'order_num' => 'SCO112101010',
                ]),
                'bizExt' => json_encode([
                    'orderId' => 10702,
                ]),
            ]));
            dump($vo);
            $res = true;
        } catch (Exception $e) {
            dump($e);
        }
        $this->assertTrue($res);
    }
}
