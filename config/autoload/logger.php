<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */
use Monolog\Formatter\LogstashFormatter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Level;

use function Hyperf\Support\env;

$logDir = env('WWW_RUNTIME_DIR', '/tmp/' . env('APP_NAME')) . '/logs/';
$formatter = [
    'class' => LogstashFormatter::class,
    'constructor' => [
        'applicationName' => env('APP_NAME'),
    ],
];

$handlers = [
    'default' => [
        'handlers' => [
            [
                'class' => RotatingFileHandler::class,
                'constructor' => [
                    'filename' => $logDir . '/info.log',
                    'level' => Level::Info,
                ],
                'formatter' => $formatter,
            ],
            [
                'class' => RotatingFileHandler::class,
                'constructor' => [
                    'filename' => $logDir . '/error.log',
                    'level' => Level::Error,
                ],
                'formatter' => $formatter,
            ],
            [
                'class' => RotatingFileHandler::class,
                'constructor' => [
                    'filename' => $logDir . '/warning.log',
                    'level' => Level::Warning,
                ],
                'formatter' => $formatter,
            ],
            [
                'class' => RotatingFileHandler::class,
                'constructor' => [
                    'filename' => $logDir . '/critical.log',
                    'level' => Level::Critical,
                ],
                'formatter' => $formatter,
            ],
        ],
    ],
];

$appEnv = env('APP_ENV', 'production');
if (in_array($appEnv, ['test', 'local', 'dev'])) {
    $handlers['default']['handlers'][] = [
        'class' => RotatingFileHandler::class,
        'constructor' => [
            'filename' => $logDir . '/debug.log',
            'level' => Level::Debug,
        ],
        'formatter' => $formatter,
    ];
}

return $handlers;
