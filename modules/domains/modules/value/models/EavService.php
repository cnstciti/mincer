<?php declare(strict_types = 1);

namespace modules\domains\modules\value\models;

use Exception;
use modules\domains\Module;

class EavService
{
    
    /**
     * сохранение
     *
     * @param int $typeValueId
     * @param int $isDelete
     */
    public static function insert(
        int $entityId,
        int $catalogAttributeId,
        int $valueId
    ): void {
        // TODO переделать через DI
        $t                     = new EavTable();
        $t->entityId           = $entityId;
        $t->catalogAttributeId = $catalogAttributeId;
        $t->valueId            = $valueId;
        $t->save();
    }
    
    /**
     * очистка
     *
     * @throws \yii\db\Exception
     * @throws Exception
     */
    public static function truncate()
    {
        Module::getInstance()
              ->getDb()
              ->createCommand()
              ->truncateTable(EavTable::tableName())
              ->execute();
    }
    
    /**
     * Обновление значения valueId записи в EAV-таблице
     *
     * @param int $entityId
     * @param int $catalogAttributeId
     * @param int $valueId
     * @param int $newValueId
     *
     * @throws Exception
     */
    public static function updateValueId(
        int $entityId,
        int $catalogAttributeId,
        int $valueId,
        int $newValueId
    ): void {
        $t          = EavTable::findOne([
            'entityId'           => $entityId,
            'catalogAttributeId' => $catalogAttributeId,
            'valueId'            => $valueId,
        ]);
        
        if ($t) {
            $t->valueId = $newValueId;
            $t->save();
        } else {
            throw new Exception(sprintf(
                'Не найдена запись в EAV-таблице. entityId: %d, catalogAttributeId: %d, valueId: %d',
                $entityId,
                $catalogAttributeId,
                $valueId
            ));
        }
    }
    
}
