<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */
namespace Uss\Message\Client\Dto\Query;

use MaliBoot\Dto\AbstractPageQuery;
use MaliBoot\Dto\Annotation\DataTransferObject;

/**
 * MessageTplAppLinkListByPageQry.
 */
#[DataTransferObject(name: 'MessageTplAppLink', type: 'query')]
class MessageTplAppLinkListByPageQry extends AbstractPageQuery
{
}
