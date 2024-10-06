<?php declare(strict_types = 1);

namespace modules\domains\modules\catalog_entity\models;

use Exception;

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
        } catch(Exception $e) {
            throw new Exception('Ошибка при создании CatalogEntity. ' . $e->getMessage());
        }
    }

}
