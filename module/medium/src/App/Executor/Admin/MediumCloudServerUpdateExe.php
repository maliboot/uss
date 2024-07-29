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
use Module\Medium\Client\Dto\MediumCloudServerUpdateDTO;
use MaliBoot\Dto\EmptyVO;
use Module\Medium\Infra\Repository\MediumCloudServerRepo;

/**
 * MediumCloudServerUpdateExe
 */
#[AppService]
class MediumCloudServerUpdateExe extends AbstractExecutor
{
    #[Inject]
    protected MediumCloudServerRepo $mediumCloudServerRepo;

    public function execute(MediumCloudServerUpdateDTO $dto): EmptyVO
    {
        $params = $dto->toArray();
        $result = $this->mediumCloudServerRepo->update($params);
        return new EmptyVO();
    }
}