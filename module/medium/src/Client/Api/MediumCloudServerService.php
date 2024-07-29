<?php

declare(strict_types=1);
/**
 * This file is part of maliboot module.
 *
 * @link     https://github.com/maliboot
 */
namespace Module\Medium\Client\Api;

use MaliBoot\Dto\IdVO;
use MaliBoot\Dto\PageVO;
use MaliBoot\Dto\MultiVO;
use MaliBoot\Dto\EmptyVO;
use Module\Medium\Client\Vo\MediumCloudServerVO;
use Module\Medium\Client\Dto\MediumCloudServerListByPageDTO;
use Module\Medium\Client\Dto\MediumCloudServerCreateDTO;
use Module\Medium\Client\Dto\MediumCloudServerUpdateDTO;

/**
 * MediumCloudServerService
 */
interface MediumCloudServerService
{
    /**
     * MediumCloudServer列表
     *
     * @param MediumCloudServerListByPageDTO $dto
     *
     * @return PageVO<MediumCloudServerVO>
     */
    public function listByPage(MediumCloudServerListByPageDTO $dto): PageVO;

    /**
     * 创建MediumCloudServer
     *
     * @param MediumCloudServerCreateDTO $dto
     *
     * @return IdVO
     */
    public function create(MediumCloudServerCreateDTO $dto): IdVO;

    /**
     * 修改MediumCloudServer
     *
     * @param MediumCloudServerUpdateDTO $dto
     * @return EmptyVO
     */
    public function update(MediumCloudServerUpdateDTO $dto): EmptyVO;

    /**
     * 删除MediumCloudServer
     *
     * @param int $id
     * @return EmptyVO
     */
    public function delete(int $id): EmptyVO;

    /**
     * 获取单个MediumCloudServer信息
     *
     * @param int $id
     * @return MediumCloudServerVO
     */
    public function getById(int $id): ?MediumCloudServerVO;
}