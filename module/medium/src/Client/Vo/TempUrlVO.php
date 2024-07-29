<?php

namespace Module\Medium\Client\Vo;

use MaliBoot\Dto\Annotation\ViewObject;
use MaliBoot\Lombok\Annotation\Field;

#[ViewObject(name: "TempUrlVO")]
class TempUrlVO
{
    #[Field(name: "temporaryUrl", type: "string", desc: "")]
    private string $temporaryUrl;
}