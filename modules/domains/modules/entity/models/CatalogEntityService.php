<?php declare(strict_types = 1);

namespace modules\domains\modules\entity\models;

class CatalogEntityService
{
    
    /**
     * сохранение
     *
     * @param CatalogEntityTable $t
     * @param int $catalogId
     * @param int $entityId
     */
    public static function insert(CatalogEntityTable $t, int $catalogId, int $entityId): void
    {
        $t->catalogId = $catalogId;
        $t->entityId  = $entityId;
        $t->save();
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
