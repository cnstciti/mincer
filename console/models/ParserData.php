<?php declare(strict_types = 1);

namespace console\models;

use Exception;
use frontend\models\parser_image_type\ParserImageTypeDataView;
use frontend\models\parser_simple_type\ParserSimpleTypeDataView;
use frontend\models\tables\ParserAttributeTable;
use frontend\models\tables\ParserEntityTable;
use frontend\models\tables\ParserValueImageTable;
use frontend\models\tables\ParserValueTable;
use modules\domains\modules\catalog_attribute\models\CatalogAttributeService;
use modules\domains\modules\catalog_entity\models\CatalogEntityService;
use modules\domains\modules\entity\models\EntityService;
use modules\domains\modules\image_type\models\image\FileDto;
use modules\domains\modules\image_type\models\image\ImgDto;
use modules\domains\modules\image_type\models\image\ImgFileDto;
use modules\domains\modules\image_type\models\ImageTypeService;
use modules\domains\modules\type_value\models\TypeValueService;
use modules\domains\modules\values\models\ValuesService;
use Throwable;
use Yii;
use yii\db\Query;
use yii\imagine\Image;

class ParserData
{
    /*
        $query = ParserEntityTable::find()
             ->where(['catalogId' => 0])
             ->orWhere(['parserSiteId' => 0])
             ->orWhere(['and', 'entityId=0', 'isBaseEntity>0'])
             ->orWhere(['and', 'isBaseEntity=0', 'entityId>0']);
        $r = $query->prepare(Yii::$app->db->queryBuilder)->createCommand()->rawSql;
        */
    
    public function check(): bool
    {
        echo 'Начало проверки' . PHP_EOL;
    
        try {
            echo '----------------' . PHP_EOL;
            echo 'Начало проверки Товаров' . PHP_EOL;
            echo '****************' . PHP_EOL;

            // готовим только уже обработанные Продукты
            $ids = (new Query())
                ->select('id')
                ->from(ParserEntityTable::tableName())
                ->andWhere('catalogId > 0')
                ->andWhere('parserSiteId > 0')
                ->andWhere(['status' => BaseParser::STATUS_FROM_PARSER])
                ->andWhere(['or',
                    'entityId = 0 and isBaseEntity > 0',
                    'isBaseEntity = 0 and entityId > 0',
                ]);
            
            // выбираем Продукты с ошибками
            $entities = ParserEntityTable::find()
                ->where(['not in', 'id', $ids])
                 ->asArray()
                 ->all();

            foreach ($entities as $entity) {
                echo "Не привязан товар: '{$entity['name']}'" . PHP_EOL;
            }

            if ($entities) {
                throw new Exception('');
            }
            echo '****************' . PHP_EOL;
            echo 'Проверка Товаров: OK' . PHP_EOL;
            echo '----------------' . PHP_EOL . PHP_EOL;
    
            echo 'Начало проверки Атрибутов' . PHP_EOL;
            echo '****************' . PHP_EOL;
    
            // выбираем Атрибуты с ошибками
            $attributes = ParserAttributeTable::find()
                 ->where(['attributeId' => 0])
                 ->andWhere(['status' => BaseParser::STATUS_FROM_PARSER])
                 ->asArray()
                 ->all();

            foreach ($attributes as $attribute) {
                echo "Не привязан атрибут: '{$attribute['name']}'" . PHP_EOL;
            }

            if ($attributes) {
                throw new Exception('');
            }
    
            echo '****************' . PHP_EOL;
            echo 'Проверка Атрибутов: OK' . PHP_EOL;
            echo '----------------' . PHP_EOL . PHP_EOL;
    
            echo '----------------' . PHP_EOL;
            echo 'Начало проверки Значений' . PHP_EOL;
            echo '****************' . PHP_EOL;
    
            // выбираем Значения с ошибками
            $values = ParserSimpleTypeDataView::find()
                 ->where(['parserDictionaryContentId' => 0])
                 ->andWhere(['typeName' => 'enum'])
                 //->andWhere(['status' => BaseParser::STATUS_FROM_PARSER])
                 ->asArray()
                 ->all();

            foreach ($values as $value) {
                echo "Не привязано значение: '{$value['meaning']}'. Словарь: '{$value['dictionaryName']}'" . PHP_EOL;
            }

            if ($values) {
                throw new Exception('');
            }
    
            echo '****************' . PHP_EOL;
            echo 'Проверка Значений: OK' . PHP_EOL;
            echo '----------------' . PHP_EOL . PHP_EOL;
    
            echo '----------------' . PHP_EOL;
            echo 'Начало проверки Изображений' . PHP_EOL;
            echo '****************' . PHP_EOL;
    
            // готовим только уже обработанные Изображения
            $ids = (new Query())
                ->select('imgId')
                ->from(ParserImageTypeDataView::tableName())
                ->where(['or',
                    'entityId = 0 and isBaseEntity > 0',
                    'isBaseEntity = 0 and entityId > 0',
                ])
            //    ->andWhere(['status' => BaseParser::STATUS_FROM_PARSER])
            ;
    
            // выбираем Изображения с ошибками
            $images = ParserImageTypeDataView::find()
                ->where(['not in', 'imgId', $ids])
                ->asArray()
                ->all();
    
            foreach ($images as $image) {
                $img = sprintf('%s/%s.%s',
                    $image['dir'], $image['fileName'], $image['extension']
                );
                echo "Не привязано изображение: '{$img}'" . PHP_EOL;
            }
    
            if ($images) {
                throw new Exception('');
            }
    
            echo '****************' . PHP_EOL;
            echo 'Проверка Изображений: OK' . PHP_EOL;
            
            $resultMsg = 'Проверка ПРОЙДЕНА!';
            $result = true;
        } catch (Throwable $e) {
            $resultMsg = 'Проверка НЕ окончена!';
            $result = false;
        }

        echo '>>>>>>>>>>>>>' . PHP_EOL . PHP_EOL;
        echo $resultMsg . PHP_EOL;
        
        return $result;
    }
    
    
    
    
    public function loadingFromParser(): void
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            echo 'Начало Загрузки' . PHP_EOL;
            echo '~~~~~~~~~~~~~~~~~~~' . PHP_EOL . PHP_EOL;
            
            if (!$this->check()) {
                throw new Exception('');
            }
    
            // выбираем Продукты, которые пришли из парсера
            $entities = ParserEntityTable::find()
                ->where(['status' => BaseParser::STATUS_FROM_PARSER])
                ->all();
    
            /** @var ParserEntityTable $entity */
            foreach ($entities as $entity) {
                $catalogEntityService = new CatalogEntityService();
    
                if ($entity->isBaseEntity) {
                    // если загружаем базовый Продукт
                    $entityService = new EntityService();
                    $entityService->create($entity->name);

                    $entity->entityId = $entityService->lastId();
                    $entity->status = BaseParser::STATUS_LOAD;
                    $entity->save();
    
                    $catalogEntityService->insert($entity->catalogId, $entity->entityId);
                    $catalogEntityId = $catalogEntityService->lastId();
                } else {
                    $entity->status = BaseParser::STATUS_LOAD;
                    $entity->save();
    
                    $catalogEntityId = $catalogEntityService->getId($entity->catalogId, $entity->entityId);
                }
                
                echo "Товар: '$entity->name'" . PHP_EOL;
    
                $values = ParserSimpleTypeDataView::find()
                    ->where(['parserEntityId' => $entity->id])
                    ->all();
    
                $valuesService = new ValuesService;
                $catalogAttributeService = new CatalogAttributeService;
                /** @var ParserSimpleTypeDataView $value */
                foreach ($values as $value) {
                    $catalogAttributeId = $catalogAttributeService->getId($value->catalogId, $value->attributeId);
                    
                    $model = $valuesService->getModelByType($value->typeName, 0);
                    $valueName = $model->getValueName();
                    switch ($value->typeName) {
                        case TypeValueService::INT:
                        case TypeValueService::FLOAT:
                        case TypeValueService::STRING:
                        case TypeValueService::TEXT:
                            $model->$valueName = $value->meaning;
                            break;
                        case TypeValueService::ENUM:
                            $model->$valueName = $value->dictionaryContentId;
                            break;
        
                        default: throw new Exception(sprintf(
                            'Не определен тип значения: %s',
                            $value->typeName
                        ));
                    }
                    
                    $valuesService->update(
                        $model,
                        $catalogAttributeId,
                        $catalogEntityId,
                        $value->typeId
                    );
    
                    $parserValue = ParserValueTable::findOne($value->valueId);
                    $parserValue->status = BaseParser::STATUS_LOAD;
                    $parserValue->save();
                    //$value->status = BaseParser::STATUS_LOAD;
                    
                    echo "Значение: '{$value['meaning']}'" . PHP_EOL;
                }
// img + eav + try/catch/
                $images = ParserImageTypeDataView::find()
                    ->where(['parserEntityId' => $entity->id])
                    ->all();
    
                /** @var ParserImageTypeDataView $image */
                foreach ($images as $image) {
                    $fileDto = new FileDto(
                        Yii::getAlias('@storageParserFolderMincerImg') . '/' . $image->dir,
                        $image->fileName,
                        $image->extension,
                        $image->size
                    );
    
                    $pathFile = Yii::getAlias('@storageParserFolderMincerImg')
                        . '/'
                        . $image->dir
                        . '/'
                        . $image->fileName
                        . '.'
                        . $image->extension;
                    
                    $pictureDto = new ImgDto(
                        Image::getImagine()->open($pathFile),
                        $image->width,
                        $image->height
                    );
    
                    $dto = new ImgFileDto(
                        $pictureDto,
                        $fileDto,
                        'uploaded'
                    );
                    
                    (new ImageTypeService)->load(
                        $dto,
                        $catalogAttributeId,
                        $catalogEntityId,
                        $image->typeId
                    );
    
                    $parserImage = ParserValueImageTable::findOne($image->imgId);
                    $parserImage->status = BaseParser::STATUS_LOAD;
                    $parserImage->save();
    
                    echo "Изображение: '{$pathFile}'" . PHP_EOL;
                }
                
            }
    
            
            
            $resultMsg = 'Загрузка ЗАКОНЧЕНА!';
    
            $transaction->commit();
        } catch (Throwable $e) {
            $resultMsg = 'Загрузка НЕ завершена!';
    
            $transaction->rollBack();
        }

        echo '~~~~~~~~~~~~~~~~~~~' . PHP_EOL . PHP_EOL;
        echo $resultMsg . PHP_EOL;
    }
    
}
