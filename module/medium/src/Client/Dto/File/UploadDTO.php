<?php

namespace Module\Medium\Client\Dto\File;

use Hyperf\HttpMessage\Upload\UploadedFile;
use MaliBoot\Dto\Annotation\DataTransferObject;
use MaliBoot\Lombok\Annotation\Field;

#[DataTransferObject(name: "UploadDTO", type: "command")]
class UploadDTO
{
    #[Field(name: "serverNo", type: "string", desc: "编号")]
    private string $serverNo;

    #[Field(name: "path", type: "string", desc: "编号")]
    private string $path;

    #[Field(name: "file", type: "object", desc: "编号")]
    private UploadedFile $file;
}