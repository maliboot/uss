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
use MaliBoot\Lombok\Annotation\Field;

#[ViewObject(name: 'result')]
class ResultVO
{
    #[Field(name: 'result', type: 'bool', desc: 'result')]
    private bool $result = false;

    #[Field(name: 'msg', type: 'string', desc: 'msg')]
    private string $msg = '';

    #[Field(name: 'requestId', type: 'string', desc: 'requestId')]
    private string $requestId = '';
}
