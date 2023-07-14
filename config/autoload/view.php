<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */
use Hyperf\View\Mode;

use function Hyperf\Support\env;

$runtime = env('WWW_RUNTIME_DIR', '/tmp/' . env('APP_NAME'));
return [
    'engine' => Hyperf\ViewEngine\HyperfViewEngine::class,
    'mode' => Mode::SYNC,
    'config' => [
        'view_path' => $runtime . '/view/',
        'cache_path' => $runtime . '/view/',
    ],
];
