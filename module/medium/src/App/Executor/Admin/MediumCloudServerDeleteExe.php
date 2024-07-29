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
use MaliBoot\Dto\EmptyVO;
use Module\Medium\Infra\Repository\MediumCloudServerRepo;

/**
 * MediumCloudServerDeleteExe
 */
#[AppService]
class MediumCloudServerDeleteExe extends AbstractExecutor
{
    #[Inject]
    protected MediumCloudServerRepo $mediumCloudServerRepo;

    public function execute(int $id): EmptyVO
    {
        
        $result = $this->mediumCloudServerRepo->delete($id);
        return new EmptyVO();
    }
}