<?php

declare(strict_types=1);
/**
 * This file is part of maliboot module.
 *
 * @link     https://github.com/maliboot
 */
namespace Module\Medium\Adapter\Admin;

use MaliBoot\Di\Annotation\Inject;
use MaliBoot\Cola\Adapter\AbstractController;
use MaliBoot\Dto\BoolVO;
use MaliBoot\Dto\IdVO;
use MaliBoot\Dto\PageVO;
use MaliBoot\Dto\MultiVO;
use MaliBoot\Dto\EmptyVO;
use MaliBoot\ApiAnnotation\ApiGroup;
use MaliBoot\ApiAnnotation\ApiVersion;
use MaliBoot\ApiAnnotation\ApiController;
use MaliBoot\ApiAnnotation\ApiMapping;
use MaliBoot\ApiAnnotation\ApiRequest;
use MaliBoot\ApiAnnotation\ApiQuery;
use MaliBoot\ApiAnnotation\ApiSingleResponse;
use MaliBoot\ApiAnnotation\ApiPageResponse;
use MaliBoot\Auth\Annotation\Auth;
use Module\Medium\App\Executor\FileExe;
use Module\Medium\Client\Dto\File\TempUrlDTO;
use Module\Medium\Client\Dto\File\UploadDTO;
use Module\Medium\Client\Vo\MediumCloudServerVO;
use Module\Medium\Client\Dto\MediumCloudServerListByPageDTO;
use Module\Medium\Client\Dto\MediumCloudServerCreateDTO;
use Module\Medium\Client\Dto\MediumCloudServerUpdateDTO;
use Module\Medium\App\Executor\Admin\MediumCloudServerListByPageExe;
use Module\Medium\App\Executor\Admin\MediumCloudServerCreateExe;
use Module\Medium\App\Executor\Admin\MediumCloudServerUpdateExe;
use Module\Medium\App\Executor\Admin\MediumCloudServerDeleteExe;
use Module\Medium\App\Executor\Admin\MediumCloudServerGetByIdExe;
use Module\Medium\Client\Vo\TempUrlVO;

/**
 * MediumCloudServerController
 */
#[ApiController(prefix: '/admin/mediumCloudServer')]
#[ApiGroup('MediumCloudServer')]
class MediumCloudServerController extends AbstractController
{
    #[Inject]
    protected FileExe $fileExe;

    /**
     * @param MediumCloudServerListByPageDTO $dto
     *
     * @return PageVO<MediumCloudServerVO>
     */
    #[ApiMapping(path: "listByPage", methods: ["GET"], name: "MediumCloudServer列表")]
    #[ApiRequest(MediumCloudServerListByPageDTO::class)]
    #[ApiPageResponse(MediumCloudServerVO::class)]
    public function listByPage(MediumCloudServerListByPageDTO $dto): PageVO
    {
        return di(MediumCloudServerListByPageExe::class)->execute($dto);
    }

    #[ApiMapping(path: "create", methods: ["POST"], name: "创建MediumCloudServer")]
    #[ApiRequest(MediumCloudServerCreateDTO::class)]
    #[ApiSingleResponse(IdVO::class)]
    public function create(MediumCloudServerCreateDTO $dto): IdVO
    {
        return di(MediumCloudServerCreateExe::class)->execute($dto);
    }

    #[ApiMapping(path: "update", methods: ["PUT"], name: "修改MediumCloudServer")]
    #[ApiRequest(MediumCloudServerUpdateDTO::class)]
    #[ApiSingleResponse(EmptyVO::class)]
    public function update(MediumCloudServerUpdateDTO $dto): EmptyVO
    {
        return di(MediumCloudServerUpdateExe::class)->execute($dto);
    }

    #[ApiMapping(path: "delete", methods: ["DELETE"], name: "删除MediumCloudServer")]
    #[ApiQuery(name: 'id', type: 'int')]
    #[ApiSingleResponse(EmptyVO::class)]
    public function delete(int $id): EmptyVO
    {
        return di(MediumCloudServerDeleteExe::class)->execute($id);
    }

    #[ApiMapping(path: "getById", methods: ["GET"], name: "获取单个MediumCloudServer信息")]
    #[ApiQuery(name: 'id', type: 'int')]
    #[ApiSingleResponse(MediumCloudServerVO::class)]
    public function getById(int $id): ?MediumCloudServerVO
    {
        return di(MediumCloudServerGetByIdExe::class)->execute($id);
    }

    #[ApiMapping(path: "upload", methods: ["POST"], name: "简单上传")]
    #[ApiRequest(UploadDTO::class)]
    #[ApiSingleResponse(EmptyVO::class)]
    public function upload(UploadDTO $dto): EmptyVO
    {
        $dto->getFile() === null && $dto->setFile($this->request->file('file'));
        return $this->fileExe->upload($dto);
    }

    #[ApiMapping(path: "temporaryUrl", methods: ["GET"], name: "获取云地址")]
    #[ApiRequest(TempUrlDTO::class)]
    #[ApiSingleResponse(TempUrlVO::class)]
    public function temporaryUrl(TempUrlDTO $dto): TempUrlVO
    {
        return $this->fileExe->temporaryUrl($dto);
    }
}