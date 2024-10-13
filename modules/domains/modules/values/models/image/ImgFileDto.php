<?php declare(strict_types=1);

namespace modules\domains\modules\value\models\image;

class ImgFileDto
{
    private ImgDto $imgDto;
    private FileDto $fileDto;
    private string $type;

    public function __construct(
        ImgDto $imgDto,
        FileDto $fileDto,
        string $type
    )
    {
        $this->imgDto = $imgDto;
        $this->fileDto = $fileDto;
        $this->type = $type;
    }
    
    public function img(): ImgDto
    {
        return $this->imgDto;
    }
    
    public function file(): FileDto
    {
        return $this->fileDto;
    }
    
    public function type(): string
    {
        return $this->type;
    }
    
}
