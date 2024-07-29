<?php

namespace Module\Medium\App\Executor;

use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpMessage\Upload\UploadedFile;
use MaliBoot\Cola\Exception\AppException;
use MaliBoot\Dto\EmptyVO;
use MaliBoot\Lombok\Annotation\Logger;
use Module\Medium\Client\Dto\File\TempUrlDTO;
use Module\Medium\Client\Dto\File\UploadDTO;
use Module\Medium\Client\Vo\TempUrlVO;
use Module\Medium\Infra\Repository\FileRepo;

#[Logger]
class FileExe
{
    #[Inject]
    protected FileRepo $fileRepo;

    public function upload(UploadDTO $dto): EmptyVO
    {
        /** @var UploadedFile $file */
        $file = $dto->getFile();
        if (! $file?->isValid()) {
            throw new AppException(400, '无效的文件');
        }
        try {
            $this->fileRepo->upload($dto->getServerNo(''), $dto->getPath(''), $file->getPath());
        } catch (\Exception $e) {
            $this->logger->error('上传异常', ['message' => $e->getMessage(), 'trace' => $e->getTrace()]);
            throw new AppException(500, '上传失败:' . $e->getMessage());
        }
        return EmptyVO::of([]);
    }

    public function temporaryUrl(TempUrlDTO $dto): TempUrlVO
    {
        try {
            $url = $this->fileRepo->temporaryUrl($dto->getServerNo(''), $dto->getPath(''), $dto->getTimeout(3600));
            return TempUrlVO::of(['temporaryUrl' => $url]);
        } catch (\Exception $e) {
            $this->logger->error('temporaryUrl', ['message' => $e->getMessage(), 'trace' => $e->getTrace()]);
            throw new AppException(500, '获取临时URl失败:' . $e->getMessage());
        }
    }
}