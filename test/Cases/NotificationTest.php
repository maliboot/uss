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

    public function testMailPush()
    {
        try {
            \Hyperf\Support\make(NotificationCmdExe::class)->execute(NotificationCmd::of([
                'tplGroupUniqid' => 'tg65449d9876ab3',
                'requestId' => md5((string) time()),
                'requestSource' => 'testUnit',
                'mailTo' => json_encode(['786300257@qq.com']),
                'title' => '车型对比配置单-汽车出口车型库',
                'content' => '您与'. date('Y年m月d日') .'下载的车型对比配置单现已准备好，请查收。',
                'mail_files' => json_encode([
                    [
                        'name' => '奥迪A6L.xlsx',
                        'path' => 'https://emao-media-dev.oss-cn-beijing.aliyuncs.com/taochemao/reportData/995cd892516b5acd80d1dc375918271b.xlsx?Expires=1730193937&OSSAccessKeyId=TMP.3KjQqT5cRV3x2uB8v3Uc71ZnUfjacz6EhXiCsfxfBtWkpiaYF2RKZtf5G5trX3q5bBhaQvcmD4A1FoQww7E1ZYjtJuPcqj&Signature=naysy6PXH9Q94piBJkSjspv1Dqk%3D',
                    ]
                ], JSON_UNESCAPED_UNICODE),
            ]));
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }
        $this->assertTrue(true);
    }
}
