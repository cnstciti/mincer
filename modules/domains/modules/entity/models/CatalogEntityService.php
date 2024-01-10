<?php declare(strict_types = 1);

namespace modules\domains\modules\entity\models;

class CatalogEntityService
{
    
    /**
     * сохранение
     *
     * @param int $catalogId
     * @param int $entityId
     */
    public static function insert(int $catalogId, int $entityId): void
    {
        // TODO переделать через DI
        $t            = new CatalogEntityTable();
        $t->catalogId = $catalogId;
        $t->entityId  = $entityId;
        $t->save();
    }
    
    /**
     * возвращает ИД
     *
     * @param int $attributeId
     * @param int $catalogId
     *
     * @return int
     * /
    public static function getId(int $attributeId=0, int $catalogId=0): int
    {
        $row = CatalogAttributeTable::findOne([
            'attributeId' => $attributeId,
            'catalogId' => $catalogId]
        );
        
        return $row ? $row->id : 0;
    }
    
    /**
     * Последний (максимальный) ИД
     *
     * @return int
     */
    public static function lastId(): int
    {
        return CatalogEntityTable::lastId();
    }

}
