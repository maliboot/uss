<?php

namespace Module\Medium\Client\Dto\File;

use Hyperf\HttpMessage\Upload\UploadedFile;
use MaliBoot\Dto\Annotation\DataTransferObject;
use MaliBoot\Lombok\Annotation\Field;

#[DataTransferObject(name: "UploadDTO", type: "command")]
class TempUrlDTO
{
    #[Field(name: "serverNo", type: "string", desc: "编号")]
    private string $serverNo;

    #[Field(name: "path", type: "string", desc: "编号")]
    private string $path;

    #[Field(name: "timeout", type: "int", desc: "有效时间")]
    private int $timeout;
}