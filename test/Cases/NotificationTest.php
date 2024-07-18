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
        try {
            \Hyperf\Support\make(NotificationCmdExe::class)->execute(NotificationCmd::of([
                'tplGroupUniqid' => 'tg654065f1625fc',
                'requestId' => md5((string) time()),
                'requestSource' => 'testUnit',
                'appPushTo' => json_encode(['18888888888']),
                'title' => 'xxxx',
                'content' => 'yyyy',
                'appLinkUri' => 'uni://page/__UNI__9C001F4?path=pages/home/index?pageId=/orderDetail',
                'appLinkAndroidUriActivity' => 'xxx://app/push',
                'bizExt' => json_encode([
                    'orderId' => 10702,
                ]),
            ]));
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }
        $this->assertTrue(true);
    }

    public function testDingDingAgentPush()
    {
        try {
            \Hyperf\Support\make(NotificationCmdExe::class)->execute(NotificationCmd::of([
                'tplGroupUniqid' => 'tg66962498dc7a9',
                'requestId' => md5((string) time()),
                'requestSource' => 'testUnit',
                'dingDingTo' => json_encode(['13131067597']),
                'title' => 'xxxx',
                'content' => 'yyyy',
                'bizExt' => json_encode([
                    'orderId' => 10702,
                ]),
            ]));
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }
        $this->assertTrue(true);
    }

    public function testFeiShuAgentPush()
    {
        try {
            \Hyperf\Support\make(NotificationCmdExe::class)->execute(NotificationCmd::of([
                'tplGroupUniqid' => 'tg6696371b010bc',
                'requestId' => md5((string) time()),
                'requestSource' => 'testUnit',
                'feiShuTo' => json_encode(['13131067597']),
                'title' => 'xxxx',
                'content' => 'yyyy',
                'bizExt' => json_encode([
                    'orderId' => 10702,
                ]),
            ]));
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }
        $this->assertTrue(true);
    }

}
