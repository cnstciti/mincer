<?php declare(strict_types = 1);

namespace modules\domains\modules\value\models\image;

class FileDto
{
    private string $dir;
    private string $fileName;
    private string $extension;
    private int $size;
    
    public function __construct(
        string $dir,
        string $fileName,
        string $extension,
        int $size
    ) {
        $this->dir       = $dir;
        $this->fileName  = $fileName;
        $this->extension = $extension;
        $this->size      = $size;
    }
    
    public function dir(): string
    {
        return $this->dir;
    }
    
    public function fileName(): string
    {
        return $this->fileName;
    }
    
    public function extension(): string
    {
        return $this->extension;
    }
    
    public function size(): int
    {
        return $this->size;
    }
    
    public function fullName(): string
    {
        $dir      = FileHelper::normalizationPath($this->dir());
        $extension = FileHelper::normalizationExtension($this->extension());
        
        return $dir . $this->fileName() . $extension;
    }
    
}
