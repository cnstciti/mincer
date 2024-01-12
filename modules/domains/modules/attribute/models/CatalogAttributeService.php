<?php declare(strict_types = 1);

namespace modules\domains\modules\attribute\models;

class CatalogAttributeService
{
    
    /**
     * сохранение
     *
     * @param CatalogAttributeTable $t
     * @param int $catalogId
     * @param int $attributeId
     */
    public static function insert(CatalogAttributeTable $t, int $catalogId, int $attributeId): void
    {
        $t->catalogId   = $catalogId;
        $t->attributeId = $attributeId;
        $t->save();
    }
    
    /**
     * Возвращает ИД
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
