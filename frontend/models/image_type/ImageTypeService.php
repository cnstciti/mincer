<?php declare(strict_types = 1);

namespace modules\domains\modules\image_type\models;

use Exception;
use modules\domains\modules\eav\models\EavService;
use modules\domains\modules\eav\models\EavTable;
use modules\domains\modules\image_type\models\image\ImgHelper;
use modules\domains\modules\image_type\models\image\FileDto;
use modules\domains\modules\image_type\models\image\ImgDto;
use modules\domains\modules\image_type\models\image\ImgFileDto;
use modules\domains\modules\value\models\ValueService;
use modules\domains\modules\value\models\ValueTable;
use modules\domains\modules\value_image\models\ValueImageTable;
use Throwable;
use Yii;
use yii\imagine\Image;
use yii\web\UploadedFile;

class ImageTypeService
{
    private const SIZE_CATALOG = 480;
    private const TYPE_CATALOG = 'catalog';
    private const SIZE_WM = 480;
    private const TYPE_WM = 'wm';
    private const SIZE_CARD = 1200;
    private const TYPE_CARD = 'card';
    //private const MAX_NUMBER_CATALOG_ORIGINAL = 6;  // TODO
    private ImgHelper $imgHelper;
    private string $storageMincerImg;
    private string $wmData;
    
    
    public function __construct()
    {
        $this->imgHelper        = new ImgHelper();
        $this->storageMincerImg = Yii::getAlias('@storageFolderMincerImg');
        $this->wmData           = Yii::getAlias('@wmData');
    }
    
    private function getStorageMincerImg(): string
    {
        return $this->storageMincerImg;
    }
    
    /**
     * Грид для изображений
     *
     * @param ImageTypeSearch $searchModel
     * @param array         $queryParams
     * @param string        $title
     * @return string
     * @throws Throwable
     */
    public function getGrid(
        ImageTypeSearch $searchModel,
        array $queryParams,
        string $title
    ): string
    {
        return ImageTypeGrid::get(
            $searchModel,
            $searchModel->search($queryParams),
            $title
        );
    }
    
    /**
     * загрузка
     * @param UploadedFile $file
     * @param int          $catalogAttributeId
     * @param int          $catalogEntityId
     * @param int          $typeId
     * @throws Exception
     */
    public function load(
        UploadedFile $file,
        int $catalogAttributeId,
        int $catalogEntityId,
        int $typeId
    ): void
    {
        /*
            /** @var yii\db\Transaction $transaction * /
            $transaction = getModule()->getDb()->beginTransaction();
            try {
            */
        $numGroup = ImageTypeDataView::find()
                                   ->select('numGroup')
                                   ->where([
                                       'catalogAttributeId' => $catalogAttributeId,
                                       'catalogEntityId' => $catalogEntityId,
                                   ])
                                   ->groupBy(['numGroup'])
                                   ->scalar();
        ++$numGroup;
        
        $valueService = new ValueService;
        $eavService = new EavService;
        
        $uploadDto = $this->getUploadedFileData($file);
        
        // изображение для каталога
        $catalogImg = $this->createCatalogImg($uploadDto);
        $valueId = $valueService->insert($typeId);
        $this->insert($catalogImg, $valueId, $numGroup);
        $eavService->insert(
            $catalogEntityId,
            $catalogAttributeId,
            $valueId
        );
        
        // изображение для карточки
        $cardImg = $this->createCardImg($uploadDto);
        $valueId = $valueService->insert($typeId);
        $this->insert($cardImg, $valueId, $numGroup);
        $eavService->insert(
            $catalogEntityId,
            $catalogAttributeId,
            $valueId
        );
        
        // изображение для каталога (с водяным знаком)
        $catalogWmImg = $this->createCatalogWmImg($uploadDto);
        $valueId = $valueService->insert($typeId);
        $this->insert($catalogWmImg, $valueId, $numGroup);
        $eavService->insert(
            $catalogEntityId,
            $catalogAttributeId,
            $valueId
        );
    }
    
    /**
     * @param ImgFileDto $dto
     * @param int        $id
     * @param int        $numGroup
     * @throws Exception
     */
    private function insert(ImgFileDto $dto, int $id, int $numGroup): void
    {
        try {
            $tmp           = new ValueImageTable();
            $tmp->id       = $id;
            $tmp->file     = $dto->file()->dir() . '/' . $dto->file()->fileName();
            $tmp->height   = $dto->img()->height();
            $tmp->width    = $dto->img()->width();
            $tmp->size     = $dto->file()->size();
            $tmp->type     = $dto->type();
            $tmp->numGroup = $numGroup;
            //$tmp->isDelete = 0;
            $tmp->save();
        } catch (Throwable $e) {
            throw new Exception('Ошибка при создании ValueImageTable. ' . $e->getMessage());
        }
    }
    
    private function getUploadedFileData(UploadedFile $file): ImgFileDto
    {
        $fileInfo = pathinfo($file->tempName);
        
        $fileDto = new FileDto(
            $fileInfo['dirname'],
            $fileInfo['filename'],
            $file->getExtension(),
            $file->size
        );
        
        [$width, $height] = getimagesize($file->tempName);
        
        $pictureDto = new ImgDto(
            Image::getImagine()->open($file->tempName),
            $width,
            $height
        );
        
        return new ImgFileDto(
            $pictureDto,
            $fileDto,
            'uploaded'
        );
    }
    
    /**
     * @param ImgFileDto $dto
     * @return ImgFileDto
     * @throws Exception
     */
    private function createCatalogImg(ImgFileDto $dto): ImgFileDto
    {
        $tmp = $this->imgHelper->resize(
            $dto,
            self::SIZE_CATALOG,
            self::TYPE_CATALOG
        );
        
        $tmp = $this->imgHelper->save($this->getStorageMincerImg(), $tmp);
        
        $result = $this->imgHelper->convertToWebp($this->getStorageMincerImg(), $tmp);
        
        $this->imgHelper->unlink($this->getStorageMincerImg(), $tmp->file()->fullName());
        
        return $result;
    }
    
    /**
     * @param ImgFileDto $dto
     * @return ImgFileDto
     * @throws Exception
     */
    private function createCatalogWmImg(ImgFileDto $dto): ImgFileDto
    {
        $tmp = $this->imgHelper->resize(
            $dto,
            self::SIZE_WM,
            self::TYPE_WM
        );
        
        $tmp = $this->imgHelper->watermark($this->wmData, $tmp);
        
        $tmp = $this->imgHelper->save($this->getStorageMincerImg(), $tmp);
        
        $result = $this->imgHelper->convertToWebp($this->getStorageMincerImg(), $tmp);
        
        $this->imgHelper->unlink($this->getStorageMincerImg(), $tmp->file()->fullName());
        
        return $result;
    }
    
    /**
     * @param ImgFileDto $dto
     * @return ImgFileDto
     * @throws Exception
     */
    private function createCardImg(ImgFileDto $dto): ImgFileDto
    {
        $tmp = $this->imgHelper->resize(
            $dto,
            self::SIZE_CARD,
            self::TYPE_CARD
        );
        
        $tmp = $this->imgHelper->save($this->getStorageMincerImg(), $tmp);
        
        $result = $this->imgHelper->convertToWebp($this->getStorageMincerImg(), $tmp);
        
        $this->imgHelper->unlink($this->getStorageMincerImg(), $tmp->file()->fullName());
        
        return $result;
    }
    
    public function getForDemo(int $entityId, int $catalogId): array
    {
        return ImageTypeDataView::find()
                              ->where([
                                  'entityId' => $entityId,
                                  'catalogId' => $catalogId,
                                  'type' => 'card',
                              ])
                              ->all();
    }
    
    public function delete(
        int $entityId,
        int $numGroup
    ): void
    {
        $imgs = ImageTypeDataView::find()
                               ->where([
                                   'entityId' => $entityId,
                                   'numGroup' => $numGroup,
                               ])
                               ->all();
        
        foreach ($imgs as $img) {
            $this->imgHelper->unlink($this->getStorageMincerImg(), $img['file']);
            
            ValueImageTable::deleteAll(['id' => $img['valueId']]);
            ValueTable::deleteAll(['id' => $img['valueId']]);
            EavTable::deleteAll(['id' => $img['eavId']]);
        }
    }
    
}
