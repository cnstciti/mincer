<?php declare(strict_types = 1);

namespace console\models;

use frontend\models\tables\ParserAttributeTable;
use frontend\models\tables\ParserEAVTable;
use frontend\models\tables\ParserEntityAttributeTable;
use frontend\models\tables\ParserEntityTable;
use frontend\models\tables\ParserValueImageTable;
use frontend\models\tables\ParserValueTable;
use modules\domains\modules\image_type\models\image\FileDto;
use modules\domains\modules\image_type\models\image\ImgDto;
use modules\domains\modules\image_type\models\image\ImgFileDto;
use modules\domains\modules\image_type\models\image\ImgHelper;
use Throwable;
use Yii;
use yii\imagine\Image;

abstract class BaseParser
{
    public const STATUS_FROM_PARSER = 'from_parser';
    public const STATUS_LOAD = 'load';
    
    
    abstract protected function runParser(): void;
    
    abstract protected function parserSiteId(): int;
    
    public function run()
    {
        echo 'Начало парсера.' . PHP_EOL;
        
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $this->runParser();
            
            $transaction->commit();
        } catch (Throwable $e) {
            $transaction->rollBack();
            echo 'Ошибка: ' . $e->getMessage() . PHP_EOL;
        }
        
        echo 'Окончание парсера.' . PHP_EOL;
    }
    
    /**
     * @param  $document
     * @param string   $mask
     * @return string
     */
    protected function getDOMElement($document, string $mask): string
    {
        try {
            return trim($document->first($mask)->text());
        } catch (Throwable $e) {
            return '';
            /*
            throw new Exception(sprintf('Ошибка получения лемента: %s. Маска: %s.%s',
                $e->getMessage(),
                $mask,
                PHP_EOL
            ));*/
        }
    }
    
    /**
     * @throws \yii\db\Exception
     */
    protected function truncateTables(): void
    {
        echo 'Очистка таблиц парсера.' . PHP_EOL;
        Yii::$app->db->createCommand()->truncateTable(ParserEntityTable::tableName())->execute();
        Yii::$app->db->createCommand()->truncateTable(ParserAttributeTable::tableName())->execute();
        Yii::$app->db->createCommand()->truncateTable(ParserEntityAttributeTable::tableName())->execute();
        Yii::$app->db->createCommand()->truncateTable(ParserValueTable::tableName())->execute();
        Yii::$app->db->createCommand()->truncateTable(ParserEAVTable::tableName())->execute();
    }
    
    protected function createEntity(string $name, int $siteId): int
    {
        try {
            // проверяем, есть ли продукт в таблице
            $entityId = ParserEntityTable::find()
                   ->select('id')
                   ->where(['name' => $name, 'parserSiteId' => $siteId])
                   ->scalar();
        
            if ( ! $entityId) {
                // если НЕ нашли продукт (в свзи с сайтом) в таблице, то создаем его
                $t               = new ParserEntityTable;
                $t->name         = $name;
                $t->parserSiteId = $this->parserSiteId();
                $t->status       = self::STATUS_FROM_PARSER;
                $t->save();
                // берем ИД продукта
                $entityId = Yii::$app->db->getLastInsertID();
            }
        } catch (Throwable $e) {
            echo sprintf('Ошибка создания продукта: %s. Продукт: %s.%s',
                $e->getMessage(),
                $name,
                PHP_EOL
            );
        }
    
        return intval($entityId);
    }
    
    protected function createAttribute(string $name): int
    {
        try {
            // проверяем, есть ли атрибут в таблице
            $attributeId = ParserAttributeTable::find()
                ->select('id')
                ->where(['name' => $name])
                ->scalar();
            
            if ( ! $attributeId) {
                // если НЕ нашли атрибут в таблице, то создаем его
                $t         = new ParserAttributeTable;
                $t->name   = $name;
                $t->status = self::STATUS_FROM_PARSER;
                $t->save();
                // берем ИД атрибута
                $attributeId = Yii::$app->db->getLastInsertID();
            }
        } catch (Throwable $e) {
            echo sprintf('Ошибка создания атрибута: %s. Атрибут: %s.%s',
                $e->getMessage(),
                $name,
                PHP_EOL
            );
        }
        
        return intval($attributeId);
    }
    
    protected function createEntityAttributeLink(int $entityId, int $attributeId): int
    {
        try {
            // проверяем, есть ли связь
            $entityAttributeId = ParserEntityAttributeTable::find()
               ->select('id')
               ->where([
                   'parserEntityId'    => $entityId,
                   'parserAttributeId' => $attributeId,
               ])
               ->scalar();
            
            if ( ! $entityAttributeId) {
                // если не нашли связь, то создаем её
                $t                    = new ParserEntityAttributeTable;
                $t->parserEntityId    = $entityId;
                $t->parserAttributeId = $attributeId;
                $t->save();
                // берем ИД связи
                $entityAttributeId = Yii::$app->db->getLastInsertID();
            }
        } catch (Throwable $e) {
            echo sprintf(
                'Ошибка создания связи Продукт - Атрибут: %s. ИД Продукта: %d. ИД атрибута: %d.%s',
                $e->getMessage(),
                $entityId,
                $attributeId,
                PHP_EOL
            );
        }
        
        return intval($entityAttributeId);
    }
    
    protected function createValue(string $meaning): int
    {
        try {
            // проверяем, есть ли значение в таблице
            $valueId = ParserValueTable::find()
               ->select('id')
               ->where(['meaning' => $meaning])
               ->scalar();
            
            if ( ! $valueId) {
                // если НЕ нашли значение в таблице, то создаем его
                $t          = new ParserValueTable;
                $t->meaning = $meaning;
                $t->status  = self::STATUS_FROM_PARSER;
                $t->save();
                // берем ИД атрибута
                $valueId = Yii::$app->db->getLastInsertID();
            }
        } catch (Throwable $e) {
            echo sprintf('Ошибка создания значения: %s. Значение: %s.%s',
                $e->getMessage(),
                $meaning,
                PHP_EOL
            );
        }
        
        return intval($valueId);
    }

    protected function createEAV(int $entityAttributeId, int $valueId): int
    {
        try {
            // проверяем, есть ли связь
            $eavId = ParserEAVTable::find()
                   ->select('id')
                   ->where([
                       'entityAttributeId' => $entityAttributeId,
                       'valueId'           => $valueId,
                   ])
                   ->scalar();
            
            if ( ! $eavId) {
                // если не нашли связь, то создаем её
                $t                    = new ParserEAVTable;
                $t->entityAttributeId = $entityAttributeId;
                $t->valueId           = $valueId;
                $t->save();
                // берем ИД связи
                $eavId = Yii::$app->db->getLastInsertID();
            }
        } catch (Throwable $e) {
            echo sprintf(
                'Ошибка создания связи Продукт - Атрибут - Значение: %s. ИД Продукт - Атрибут: %d. ИД значения: %d.%s',
                $e->getMessage(),
                $entityAttributeId,
                $valueId,
                PHP_EOL
            );
        }
        
        return intval($eavId);
    }
    
    protected function createImage(array $pathInfo, string $pathFile): int
    {
        try {
            $imgHelper = new ImgHelper();
            $storageParserMincerImg = Yii::getAlias('@storageParserFolderMincerImg');
    
            $fileDto = new FileDto(
                '',
                $pathInfo['filename'],
                $pathInfo['extension'],
                0
            );
    
            [$width, $height] = getimagesize($pathFile);
    
            $pictureDto = new ImgDto(
                Image::getImagine()->open($pathFile),
                $width,
                $height
            );
    
            $imgFileDto =  new ImgFileDto(
                $pictureDto,
                $fileDto,
                ''
            );
    
            // проверяем, есть ли связь
            $parserValueImageId = ParserValueImageTable::find()
                ->select('id')
                ->where(['fileName' => $pathInfo['filename'],])
                ->scalar();
            
            if (!$parserValueImageId) {
                $dto = $imgHelper->save($storageParserMincerImg, $imgFileDto);
    
                $t            = new ParserValueImageTable();
                $t->dir       = $dto->file()->dir();
                $t->fileName  = $dto->file()->fileName();
                $t->extension = $dto->file()->extension();
                $t->height    = $dto->img()->height();
                $t->width     = $dto->img()->width();
                $t->size      = $dto->file()->size();
                $t->status    = self::STATUS_FROM_PARSER;
                $t->save();
                $parserValueImageId = Yii::$app->db->getLastInsertID();
            }
        } catch (Throwable $e) {
            echo sprintf(
                'Ошибка создания изображения: %s.%s',
                $e->getMessage(),
                PHP_EOL
            );
        }
    
        return intval($parserValueImageId);
    }
    
}
