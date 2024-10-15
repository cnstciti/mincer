<?php declare(strict_types=1);

namespace modules\domains\modules\image_type\models\image;

use Imagine\Image\ImageInterface;

class ImgDto
{
    private ImageInterface $handle;
    private int $width;
    private int $height;

    public function __construct(
        ImageInterface $handle,
        int $width,
        int $height
    )
    {
        $this->handle = $handle;
        $this->width = $width;
        $this->height = $height;
    }
    
    public function handle(): ImageInterface
    {
        return $this->handle;
    }
    
    public function width(): int
    {
        return $this->width;
    }
    
    public function height(): int
    {
        return $this->height;
    }
    
}
