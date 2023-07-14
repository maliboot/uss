<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */
return [
    'handler' => [
        'http' => [
            \MaliBoot\Validation\Exception\Handler\ValidationExceptionHandler::class,
            \MaliBoot\ExceptionHandler\Handler\ThrowableExceptionHandler::class,
        ],
    ],
];
