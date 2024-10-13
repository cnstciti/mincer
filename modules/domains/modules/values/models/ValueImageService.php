<?php declare(strict_types = 1);

namespace modules\domains\modules\value\models;

use Exception;
use modules\domains\Module as BaseModule;
use modules\domains\modules\eav\models\EavService;
use modules\domains\modules\eav\models\EavTable;
use modules\domains\modules\value\models\image\FileDto;
use modules\domains\modules\value\models\image\ImgDto;
use modules\domains\modules\value\models\image\ImgFileDto;
use modules\domains\modules\value\models\image\ImgHelper;
use Yii;
use yii\imagine\Image;
use yii\web\UploadedFile;

class ValueImageService
{
    private const SIZE_CATALOG = 480;
    private const TYPE_CATALOG = 'catalog';
    private const SIZE_WM = 480;
    private const TYPE_WM = 'wm';
    private const SIZE_CARD = 1200;
    private const TYPE_CARD = 'card';
    private const MAX_NUMBER_CATALOG_ORIGINAL = 6;
    private ImgHelper $imgHelper;
    private string $storageMincerImg;
    private string $wmData;
    
    
    public function __construct()
    {
        // TODO из папки переложить на сервер
        $this->imgHelper        = new ImgHelper();
        $this->storageMincerImg = Yii::getAlias('@storageFolderMincerImg');
        $this->wmData           = Yii::getAlias('@wmData');
    }
    
    public function getStorageMincerImg(): string
    {
        return $this->storageMincerImg;
    }

    /**
     * загрузка
     */
    /**
     * @param UploadedFile    $file
     //// * @param ValueImageTable $model
     * @param int             $catalogAttributeId
     * @param int             $catalogEntityId
     * @param int             $typeId
     * @throws \yii\db\Exception
     */
    public function load(
        UploadedFile $file,
        //ValueImageTable $model,
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
        $numGroup = ImgTypeDataView::find()
            ->select('numGroup')
            ->where([
                'catalogAttributeId' => $catalogAttributeId,
                'catalogEntityId' => $catalogEntityId,
            ])
            ->groupBy(['numGroup'])
            ->scalar();
        ++$numGroup;

        $valueService = new ValuesService;
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
    
    
        /*
                    $isSavePicture = false;
                    foreach ($ids as $idProduct) {
                        $countCatalogOriginal = Picture::countCatalogOriginal($idProduct);
                    
                        if ($countCatalogOriginal < Picture::MAX_NUMBER_CATALOG_ORIGINAL) {
                            if (!$isSavePicture) {
                                $idCatalogOriginal = Picture::saveObject(
                                    $catalogOriginalWebpDto,
                                    $this->isDelete,
                                    $this->isVisible
                                );
                            }
                        
                            EntityPicture::saveObject(
                                $idProduct,
                                $idCatalogOriginal,
                                $this->sequenceNumber
                            );
                        
                            if (!$isSavePicture) {
                                $idCatalogWM = Picture::saveObject(
                                    $catalogWMWebpDto,
                                    $this->isDelete,
                                    $this->isVisible
                                );
                            }
                        
                            EntityPicture::saveObject(
                                $idProduct,
                                $idCatalogWM,
                                $this->sequenceNumber
                            );
                        }
                    
                        if (!$isSavePicture) {
                            $idCardOriginal = Picture::saveObject(
                                $cardOriginalWebpDto,
                                $this->isDelete,
                                $this->isVisible
                            );
                        }
                    
                        EntityPicture::saveObject(
                            $idProduct,
                            $idCardOriginal,
                            $this->sequenceNumber
                        );
                    
                        if (!$isSavePicture) {
                            $idCardThumb = Picture::saveObject(
                                $cardThumbWebpDto,
                                $this->isDelete,
                                $this->isVisible
                            );
                        }
                    
                        EntityPicture::saveObject(
                            $idProduct,
                            $idCardThumb,
                            $this->sequenceNumber
                        );
                    
                        $isSavePicture = true;
                    }
                
                    $transaction->commit();
                } catch (Throwable $e) {
                    $file = $alias . '/' . $catalogOriginalDto->file()->fullName();
                    if (file_exists($file)) {
                        PictureHelper::unlink($alias, $catalogOriginalDto);
                    }
                
                    $file = $alias . '/' . $catalogOriginalWebpDto->file()->fullName();
                    if (file_exists($file)) {
                        PictureHelper::unlink($alias, $catalogOriginalWebpDto);
                    }
                
                    $file = $alias . '/' . $catalogWMDto->file()->fullName();
                    if (file_exists($file)) {
                        PictureHelper::unlink($alias, $catalogWMDto);
                    }
                
                    $file = $alias . '/' . $catalogWMWebpDto->file()->fullName();
                    if (file_exists($file)) {
                        PictureHelper::unlink($alias, $catalogWMWebpDto);
                    }
                
                    $file = $alias . '/' . $cardOriginalDto->file()->fullName();
                    if (file_exists($file)) {
                        PictureHelper::unlink($alias, $cardOriginalDto);
                    }
                
                    $file = $alias . '/' . $cardOriginalWebpDto->file()->fullName();
                    if (file_exists($file)) {
                        PictureHelper::unlink($alias, $cardOriginalWebpDto);
                    }
                
                    $file = $alias . '/' . $cardThumbDto->file()->fullName();
                    if (file_exists($file)) {
                        PictureHelper::unlink($alias, $cardThumbDto);
                    }
                
                    $file = $alias . '/' . $cardThumbWebpDto->file()->fullName();
                    if (file_exists($file)) {
                        PictureHelper::unlink($alias, $cardThumbWebpDto);
                    }
                
                    $transaction->rollBack();
                    throw $e;
                }
                */
    }

    private function insert(ImgFileDto $dto, int $id, int $numGroup): void
    {
        $tmp           = new ValueImageTable();
        $tmp->id       = $id;
        $tmp->file     = $dto->file()->dir() . '/' . $dto->file()->fileName();
        $tmp->height   = $dto->img()->height();
        $tmp->width    = $dto->img()->width();
        $tmp->size     = $dto->file()->size();
        $tmp->ext      = $dto->file()->extension();
        $tmp->type     = $dto->type();
        $tmp->numGroup = $numGroup;
        $tmp->isDelete = 0;
        $tmp->save();
    }

    /**
     * очистка
     *
     * @throws \yii\db\Exception
     * @throws Exception
     * /
    public function truncate()
    {
        BaseModule::getInstance()
              ->getDb()
              ->createCommand()
              ->truncateTable(ValueIntTable::tableName())
              ->execute();
    }
    */
    
    /**
     * Получение модели
     *
     * @param int $id
     * @return ValueImageTable
     */
    public function getModel(int $id=0): ValueImageTable
    {
        return ValueImageTable::findOne($id) ?? new ValueImageTable;
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
        return ImgTypeDataView::find()
            ->where([
                'entityId' => $entityId,
                'catalogId' => $catalogId,
                'type' => 'card',
            ])
            ->all();
            /*
            "
            select d1.name as original, d2.name as thumb
            from (
                select ep.sequenceNumber, p.name
                from picture p
                left join entity_picture ep on ep.idPicture = p.id
                where ep.idEntity = :idEntity
                  and p.type = :original
                  and p.isDelete=0 and p.isVisible=1
            ) d1,
            (
                select ep.sequenceNumber, p.name
                from picture p
                left join entity_picture ep on ep.idPicture = p.id
                where ep.idEntity = :idEntity
                  and p.type = :thumb
                  and p.isDelete=0 and p.isVisible=1
            ) d2
            where d1.sequenceNumber = d2.sequenceNumber
            order by d1.sequenceNumber
        ";
        
        return self::getDb()->createCommand($query)
                   ->bindValue(':idEntity', $idEntity)
                   ->bindValue(':original', self::TYPE_CARD_ORIGINAL)
                   ->bindValue(':thumb', self::TYPE_CARD_THUMB)
                   ->queryAll();*/
    }
    
    public function delete(
        //int $valueId,
        int $entityId,
        int $numGroup
    ): void
    {
        $imgs = ImgTypeDataView::find()
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
