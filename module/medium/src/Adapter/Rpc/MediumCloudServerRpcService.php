<?php

declare(strict_types=1);
/**
 * This file is part of maliboot module.
 *
 * @link     https://github.com/maliboot
 */
namespace Module\Medium\Adapter\Rpc;

use MaliBoot\Di\Annotation\Inject;
use MaliBoot\Cola\Adapter\AbstractRpcService;
use MaliBoot\Cola\Annotation\API;
use MaliBoot\Cola\Annotation\Method;
use MaliBoot\Dto\IdVO;
use MaliBoot\Dto\PageVO;
use MaliBoot\Dto\MultiVO;
use MaliBoot\Dto\EmptyVO;
use Module\Medium\Client\Vo\MediumCloudServerVO;
use Module\Medium\Client\Dto\MediumCloudServerListByPageDTO;
use Module\Medium\Client\Dto\MediumCloudServerCreateDTO;
use Module\Medium\Client\Dto\MediumCloudServerUpdateDTO;
use Module\Medium\App\Executor\Admin\MediumCloudServerListByPageExe;
use Module\Medium\App\Executor\Admin\MediumCloudServerCreateExe;
use Module\Medium\App\Executor\Admin\MediumCloudServerUpdateExe;
use Module\Medium\App\Executor\Admin\MediumCloudServerDeleteExe;
use Module\Medium\App\Executor\Admin\MediumCloudServerGetByIdExe;
use Module\Medium\Client\Api\MediumCloudServerService;

/**
 * MediumCloudServerRpcService
 */
#[API(name: "MediumCloudServer")]
class MediumCloudServerRpcService extends AbstractRpcService implements MediumCloudServerService
{
    /**
     * @param MediumCloudServerListByPageDTO $dto
     *
     * @return PageVO<MediumCloudServerVO>
     */
    #[Method(name: "MediumCloudServer列表")]
    public function listByPage(MediumCloudServerListByPageDTO $dto): PageVO
    {
        return di(MediumCloudServerListByPageExe::class)->execute($dto);
    }

    /**
     * @param MediumCloudServerCreateDTO $dto
     *
     * @return IdVO
     */
    #[Method(name: "创建MediumCloudServer")]
    public function create(MediumCloudServerCreateDTO $dto): IdVO
    {
        return di(MediumCloudServerCreateExe::class)->execute($dto);
    }

    /**
     * @param MediumCloudServerUpdateDTO $dto
     * @return EmptyVO
     */
    #[Method(name: "修改MediumCloudServer")]
    public function update(MediumCloudServerUpdateDTO $dto): EmptyVO
    {
        return di(MediumCloudServerUpdateExe::class)->execute($dto);
    }

    /**
     * @param int $id
     * @return EmptyVO
     */
    #[Method(name: "删除MediumCloudServer")]
    public function delete(int $id): EmptyVO
    {
        return di(MediumCloudServerDeleteExe::class)->execute($id);
    }

    /**
     * @param int $id
     * @return MediumCloudServerVO
     */
     #[Method(name: "获取单个MediumCloudServer信息")]
    public function getById(int $id): ?MediumCloudServerVO
    {
        return di(MediumCloudServerGetByIdExe::class)->execute($id);
    }
}