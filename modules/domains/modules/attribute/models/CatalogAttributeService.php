<?php declare(strict_types = 1);

namespace modules\domains\modules\attribute\models;

class CatalogAttributeService
{
    
    /**
     * сохранение
     *
     * @param int $catalogId
     * @param int $attributeId
     */
    public static function insert(int $catalogId, int $attributeId): void
    {
        // TODO переделать через DI
        $t              = new CatalogAttributeTable();
        $t->catalogId   = $catalogId;
        $t->attributeId = $attributeId;
        $t->save();
    }
    
    /**
     * возвращает ИД
     *
     * @param int $attributeId
     * @param int $catalogId
     *
     * @return int
     */
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
        return CatalogAttributeTable::lastId();
    }
    
}
