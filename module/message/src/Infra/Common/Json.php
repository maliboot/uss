<?php

namespace Uss\Message\Infra\Common;

class Json
{
    public static function decode(string $json): array
    {
        if (empty($json)) {
            return [];
        }
        $result = json_decode($json, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return [];
        }
        return $result;
    }
}