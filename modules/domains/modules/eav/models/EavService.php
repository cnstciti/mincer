<?php declare(strict_types = 1);

namespace modules\domains\modules\eav\models;

use Exception;
use Throwable;

class EavService
{
    
    /**
     * сохранение
     *
     * @param int $catalogEntityId
     * @param int $catalogAttributeId
     * @param int $valueId
     * @throws Exception
     */
    public function insert(
        int $catalogEntityId,
        int $catalogAttributeId,
        int $valueId
    ): void
    {
        try {
            $t                     = new EavTable();
            $t->catalogEntityId    = $catalogEntityId;
            $t->catalogAttributeId = $catalogAttributeId;
            $t->valueId            = $valueId;
            $t->save();
        } catch (Throwable $e) {
            throw new Exception('Ошибка при создании EAV. ' . $e->getMessage());
        }
    }
    
    /**
     * Обновление значения valueId записи в EAV-таблице
     *
     * @param int $catalogEntityId
     * @param int $catalogAttributeId
     * @param int $valueId
     * @param int $newValueId
     * @throws Exception
     */
    public function update(
        int $catalogEntityId,
        int $catalogAttributeId,
        int $newValueId
    ): void
    {
        $t = EavTable::findOne([
            'catalogEntityId'    => $catalogEntityId,
            'catalogAttributeId' => $catalogAttributeId,
        ]);
        
        if ($t) {
            $t->valueId = $newValueId;
            $t->save();
        } else {
            throw new Exception(sprintf(
                'Не найдена запись в EAV-таблице. catalogEntityId: %d, catalogAttributeId: %d',
                $catalogEntityId,
                $catalogAttributeId
            ));
        }
    }
    
    /**
     * Проверяет, существует ли запись с переданными параметрами
     *
     * @param int $catalogEntityId
     * @param int $catalogAttributeId
     * @return bool
     */
    public function isExist(int $catalogEntityId, int $catalogAttributeId): bool
    {
        return EavTable::findOne([
            'catalogEntityId'    => $catalogEntityId,
            'catalogAttributeId' => $catalogAttributeId,
        ]) ? true : false;
    }
    
    /**
     * Удаление записей по условиям
     *
     * @param int $catalogEntityId
     * @param int $catalogAttributeId
     */
    public function delete(int $catalogEntityId, int $catalogAttributeId): void
    {
        EavTable::deleteAll([
            'catalogEntityId'    => $catalogEntityId,
            'catalogAttributeId' => $catalogAttributeId,
        ]);
    }
    
}
