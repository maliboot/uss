<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */

namespace Uss\Message\Client\ViewObject;

use MaliBoot\Dto\Annotation\ViewObject;

#[ViewObject(name: 'result')]
class ResultVO
{
    /**
     * result.
     */
    private bool $result = false;

    /**
     * msg.
     */
    private string $msg = '';

    /**
     * requestId.
     */
    private string $requestId = '';
}
