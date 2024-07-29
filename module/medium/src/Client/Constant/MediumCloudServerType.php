<?php

namespace Module\Medium\Client\Constant;

enum MediumCloudServerType: int
{
    case LOCAL = 0;
    case OSS = 1;
    case COS = 2;
}