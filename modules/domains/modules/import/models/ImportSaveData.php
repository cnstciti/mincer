<?php declare(strict_types = 1);

namespace modules\domains\modules\import\models;

use Exception;
use modules\domains\modules\entity\models\CatalogEntityService;
use modules\domains\modules\entity\models\EntityService;
use modules\domains\modules\value\models\values\ValueFactory;
use Throwable;
use Yii;

class ImportSaveData
{
    public static $maxValueId = 0;
    
    
    /**
     * Сохранение продукта. Возвращает ИД сохранененной записи
     *
     * @param int $catalogId
     *
     * @return int
     * @throws Exception
     */
    public static function saveEntity(): int
    {
        try {
            Yii::$container->invoke(
                [
                    new EntityService,
                    'insert',
                ],
                [
                    'entityName' => ImportGetData::entityName(),
                ]
            );
        } catch (Throwable $e) {
            throw new Exception(sprintf(
                'Ошибка вызова EntityService->insert: %s',
                $e->getMessage()
            ));
        }

        return EntityService::lastId();
    }

    public static function saveCatalogEntity(int $catalogId, int $entityId): int
    {
        try {
            Yii::$container->invoke(
                [
                    new CatalogEntityService,
                    'insert',
                ],
                [
                    'catalogId' => $catalogId,
                    'entityId' => $entityId,
                ]
            );
        } catch (Throwable $e) {
            throw new Exception(sprintf(
                'Ошибка вызова CatalogEntityService->insert: %s',
                $e->getMessage()
            ));
        }

        return CatalogEntityService::lastId();
    }

    /**
     * Вставка значения. Возвращает ИД вставленной записи
     *
     * @param array $attribute
     * @param array $value
     *
     * @return int
     * @throws Exception
     */
    public static function saveValue(array $attribute, array $value): int
    {
        $valueObject = ValueFactory::getValueObject(ImportGetData::typeName($attribute));
        
        return $valueObject->insert(
            $value,
            ImportGetData::typeId($attribute),
            self::$maxValueId,
            ImportGetData::dictionaryId($attribute),
            ImportGetData::dictionaryName($attribute)
        );
    }
    
}
