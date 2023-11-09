<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */

namespace Uss\Message;

use MaliBoot\Plugin\AbstractPlugin;

class Plugin extends AbstractPlugin
{
    protected static string $dir = __DIR__;

    protected function config(): array
    {
        return [
            'commands' => [],
            'dependencies' => [],
            'listeners' => [],
            'processes' => [
            ],
            'annotations' => [
                'scan' => [
                    'paths' => [__DIR__],
                ],
            ],
            'publish' => [],
        ];
    }
}
