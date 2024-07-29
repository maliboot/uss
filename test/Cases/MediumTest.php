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
use Uss\Message\App\Executor\Command\NotificationCmdExe;
use Uss\Message\Client\Dto\Command\NotificationCmd;

/**
 * @internal
 * @coversNothing
 */
class MediumTest extends TestCase
{
    public function testMediumExample()
    {
        $this->get('/')->assertOk()->assertSee('Hyperf');
    }
}
