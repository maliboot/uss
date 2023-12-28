<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */
use MaliBoot\Database\Listener\DbQueryExecutedDebugListener;

return [
    Hyperf\ExceptionHandler\Listener\ErrorExceptionHandler::class,
    Hyperf\Command\Listener\FailToHandleListener::class,
    DbQueryExecutedDebugListener::class,
];
