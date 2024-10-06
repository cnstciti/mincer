<?php declare(strict_types = 1);

namespace modules\domains\modules\catalog_attribute\models;

use Exception;

class CatalogAttributeService
{
    
    /**
     * сохранение
     *
     * @param int $catalogId
     * @param int $attributeId
     * @throws Exception
     */
    public function insert(int $catalogId, int $attributeId): void
    {
        try {
            $t              = new CatalogAttributeTable();
            $t->catalogId   = $catalogId;
            $t->attributeId = $attributeId;
            $t->save();
        } catch(Exception $e) {
            throw new Exception('Ошибка при создании CatalogAttribute. ' . $e->getMessage());
        }
    }

}
