<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */
namespace Uss\Message\Client\ViewObject;

use MaliBoot\Dto\AbstractViewObject;
use MaliBoot\Dto\Annotation\Field;
use MaliBoot\Dto\Annotation\ViewObject;

/**
 * @method string getMsg() 获取msg.
 * @method self setMsg(string $msg) 设置msg.
 * @method string getRequestId() 获取requestId.
 * @method self setRequestId(string $requestId) 设置requestId.
 * @method bool getResult() ...
 * @method self setResult(bool $result) ...
 */
#[ViewObject(name: 'result')]
class ResultVO extends AbstractViewObject
{
    #[Field(name: 'result', type: 'bool')]
    private bool $result = false;

    #[Field(name: 'msg', type: 'string')]
    private string $msg = '';

    #[Field(name: 'requestId', type: 'string')]
    private string $requestId = '';
}
