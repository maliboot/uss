<?php

declare(strict_types=1);
/**
 * This file is part of maliboot module.
 *
 * @link     https://github.com/maliboot
 */
namespace Module\Medium\App\Executor\Admin;

use MaliBoot\Di\Annotation\Inject;
use MaliBoot\Cola\App\AbstractExecutor;
use MaliBoot\Cola\Annotation\AppService;
use Module\Medium\Client\Dto\MediumCloudServerListByPageDTO;
use MaliBoot\Dto\PageVO;
use Module\Medium\Infra\Repository\MediumCloudServerRepo;

/**
 * MediumCloudServerListByPageExe
 */
#[AppService]
class MediumCloudServerListByPageExe extends AbstractExecutor
{
    #[Inject]
    protected MediumCloudServerRepo $mediumCloudServerRepo;

    public function execute(MediumCloudServerListByPageDTO $dto): PageVO
    {
        $params = $dto; // do something...
        $result = $this->mediumCloudServerRepo->listByPage($params);
        return $result;
    }
}