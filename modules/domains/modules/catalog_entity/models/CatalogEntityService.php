<?php declare(strict_types = 1);

namespace modules\domains\modules\catalog_entity\models;

use Exception;
use Throwable;

class CatalogEntityService
{
    
    /**
     * сохранение
     *
     * @param int $catalogId
     * @param int $entityId
     * @throws Exception
     */
    public function insert(int $catalogId, int $entityId): void
    {
        try {
            $t            = new CatalogEntityTable();
            $t->catalogId = $catalogId;
            $t->entityId  = $entityId;
            $t->save();
        } catch (Throwable $e) {
            throw new Exception('Ошибка при создании CatalogEntity. ' . $e->getMessage());
        }
    }
    
    /**
     * Последний (максимальный) ИД
     *
     * @return int
     */
    public function lastId(): int
    {
        return CatalogEntityTable::lastId();
    }

    public function getId(int $catalogId, int $entityId): int
    {
        return CatalogEntityTable::findOne(['catalogId' => $catalogId, 'entityId' => $entityId])->id;
    }
    
}
