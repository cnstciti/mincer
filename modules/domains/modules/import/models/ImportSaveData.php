<?php declare(strict_types = 1);

namespace modules\domains\modules\import\models;

use Exception;
use modules\domains\modules\entity\models\CatalogEntityService;
use modules\domains\modules\entity\models\EntityService;
use modules\domains\modules\value\models\values\ValueFactory;

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
        EntityService::insert(ImportGetData::entityName());
        
        return EntityService::lastId();
    }

    public static function saveCatalogEntity(int $catalogId, int $entityId): int
    {
        CatalogEntityService::insert($catalogId, $entityId);

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
            ImportGetData::dictionaryId($attribute)/*,
            ImportGetData::dictionaryName($attribute)*/
        );
    }
    
}
