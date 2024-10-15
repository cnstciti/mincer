<?php declare(strict_types=1);

namespace modules\domains\modules\image_type\models\image;

use Exception;
use RuntimeException;
use yii\helpers\BaseFileHelper;
use yii\imagine\Image;

class ImgHelper
{

    public function resize(ImgFileDto $dto, int $maxSize, string $type): ImgFileDto
    {
        if ($dto->img()->width() > $maxSize
            || $dto->img()->height() > $maxSize
        ) {
            $file = $dto->file()->dir() . '/' . $dto->file()->fileName() . '.tmp';
            if ($dto->img()->width() < $dto->img()->height()) {
                $resizeFileObject = Image::resize($file, null, $maxSize);
            } else {
                $resizeFileObject = Image::resize($file, $maxSize, null);
            }
        } else {
            $resizeFileObject = $dto->img()->handle();
        }
    
        $fileDto = new FileDto(
            '',
            '',
            $dto->file()->extension(),
            0
        );
    
        $size = $resizeFileObject->getSize();
    
        $imgDto = new ImgDto(
            $resizeFileObject,
            $size->getWidth(),
            $size->getHeight()
        );
    
        return new ImgFileDto(
            $imgDto,
            $fileDto,
            $type
        );
    }
    
    /**
     * @param string     $alias
     * @param ImgFileDto $dto
     * @return ImgFileDto
     * @throws Exception
     */
    public function convertToWebp(string $alias, ImgFileDto $dto): ImgFileDto
    {
        switch ($dto->file()->extension()) {
            case 'png':
                $img = imagecreatefrompng($alias . '/' . $dto->file()->fullName());
                break;
            case 'jpeg':
            case 'jpg':
                $img = imagecreatefromjpeg($alias . '/' . $dto->file()->fullName());
                break;
            default:
                throw new Exception('невозможно определить расширение файла');
        }
    
        $fullName = $dto->file()->fileName() . '.webp';
        $fileWebp = $alias . '/' . $dto->file()->dir() . '/' . $fullName;
        if (!imagewebp($img, $fileWebp)) {
            throw new Exception('файл с расширением WEBP не был сохранен');
        }
    
        $fileDto = new FileDto(
            $dto->file()->dir(),
            $fullName,
            'webp',
            FileHelper::getSizeFile($fileWebp)
        );
    
        [$width, $height] = getimagesize($fileWebp);
        
        $imgDto = new ImgDto(
            Image::getImagine()->open($fileWebp),
            $width,
            $height
        );
    
        return new ImgFileDto(
            $imgDto,
            $fileDto,
            $dto->type()
        );
    }
    
    public function save(string $alias, ImgFileDto $dto): ImgFileDto
    {
        $dir = empty($dto->file()->dir())
            ? FileHelper::generateRandomSubPath()
            : FileHelper::normalizationPath($dto->file()->dir());
        $name = empty($dto->file()->fileName())
            ? FileHelper::getRandomFileName($dir, $dto->file()->extension())
            : $dto->file()->fileName();
        $extension = FileHelper::normalizationExtension($dto->file()->extension());
        
        $fullName = $name . $extension;
        $fullPath = $alias . '/' . $dir;
        
        try {
            BaseFileHelper::createDirectory($fullPath, $mode = 0777);
            /*
            $connection = ssh2_connect('static.mincer.local', 22);
            //ssh2_auth_password($connection, 'username', 'password');
            $sftp = ssh2_sftp($connection);
    
            ssh2_sftp_mkdir($sftp, $fullPath);
            */
        } catch (Exception $e) {
            throw new RuntimeException($e->getMessage());
        }
    
        $file = $fullPath . '/' . $fullName;
        $dto->img()->handle()->save($file);
    
        $fileDto = new FileDto(
            $dir,
            $name,
            $dto->file()->extension(),
            FileHelper::getSizeFile($file)
        );
    
        $size = $dto->img()->handle()->getSize();
    
        $imgDto = new ImgDto(
            $dto->img()->handle(),
            $size->getWidth(),
            $size->getHeight()
        );
    
        return new ImgFileDto(
            $imgDto,
            $fileDto,
            $dto->type()
        );
    }
    
    public function unlink(string $alias, string $file): bool
    {
        return BaseFileHelper::unlink($alias . '/' . $file);
    }
    
    public function watermark(string $aliasWM, ImgFileDto $dto): ImgFileDto
    {
        // Уменьшаем Водяной знак
        $watermark = $aliasWM . '/wm.png';
        if ($dto->img()->width() < $dto->img()->height()) {
            $watermarkObject = Image::resize($watermark, $dto->img()->width(), null);
        } else {
            $watermarkObject = Image::resize($watermark, null, $dto->img()->height());
        }
        
        $size = $watermarkObject->getSize();
        $widthWatermark = $size->getWidth();
        $heightWatermark = $size->getHeight();
        
        // вычисляем координаты
        $x = intval(($dto->img()->width() - $widthWatermark)/2);
        $y = intval(($dto->img()->height() - $heightWatermark)/2);
    
        $watermarkObject = Image::watermark($dto->img()->handle(), $watermarkObject, [$x, $y]);
    
        $fileDto = new FileDto(
            '',
            '',
            $dto->file()->extension(),
            0
        );
    
        $size = $watermarkObject->getSize();
    
        $imgDto = new ImgDto(
            $watermarkObject,
            $size->getWidth(),
            $size->getHeight()
        );
    
        return new ImgFileDto(
            $imgDto,
            $fileDto,
            $dto->type()
        );
    }

}
