<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */

namespace Uss\Message\Client\Dto\Query;

use MaliBoot\Dto\Annotation\DataTransferObject;

/**
 * MessageListByPageQry.
 */
#[DataTransferObject(name: 'Message', type: 'query-page')]
class MessageListByPageQry {}
