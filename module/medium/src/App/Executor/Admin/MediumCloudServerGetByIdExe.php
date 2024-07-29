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
use Module\Medium\Client\Vo\MediumCloudServerVO;
use Module\Medium\Infra\Repository\MediumCloudServerRepo;

/**
 * MediumCloudServerGetByIdExe
 */
#[AppService]
class MediumCloudServerGetByIdExe extends AbstractExecutor
{
    #[Inject]
    protected MediumCloudServerRepo $mediumCloudServerRepo;

    public function execute(int $id): ?MediumCloudServerVO
    {
        
        $result = $this->mediumCloudServerRepo->getById($id);
        return MediumCloudServerVO::ofDO($result);
    }
}