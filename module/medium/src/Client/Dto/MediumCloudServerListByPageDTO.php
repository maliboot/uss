<?php

declare(strict_types=1);
/**
 * This file is part of maliboot module.
 *
 * @link     https://github.com/maliboot
 */
namespace Module\Medium\Client\Dto;

use MaliBoot\Dto\Annotation\DataTransferObject;
use MaliBoot\Lombok\Annotation\Field;

/**
 * MediumCloudServerListByPageDTO
 */
#[DataTransferObject(name: "MediumCloudServerListByPage", type: "query-page")]
class MediumCloudServerListByPageDTO
{

}