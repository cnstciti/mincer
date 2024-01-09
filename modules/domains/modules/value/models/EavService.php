<?php declare(strict_types = 1);

namespace modules\domains\modules\value\models;

use Exception;
use modules\domains\Module;

class EavService
{
    
    /**
     * сохранение
     *
     * @param int $catalogEntityId
     * @param int $catalogAttributeId
     * @param int $valueId
     * @return void
     */
    public static function insert(
        int $catalogEntityId,
        int $catalogAttributeId,
        int $valueId
    ): void {
        // TODO переделать через DI
        $t                     = new EavTable();
        $t->catalogEntityId    = $catalogEntityId;
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
     * @param int $catalogEntityId
     * @param int $catalogAttributeId
     * @param int $valueId
     * @param int $newValueId
     *
     * @throws Exception
     */
    public static function updateValueId(
        int $catalogEntityId,
        int $catalogAttributeId,
        int $valueId,
        int $newValueId
    ): void {
        $t = EavTable::findOne([
            'catalogEntityId'    => $catalogEntityId,
            'catalogAttributeId' => $catalogAttributeId,
            'valueId'            => $valueId,
        ]);
        
        if ($t) {
            $t->valueId = $newValueId;
            $t->save();
        } else {
            throw new Exception(sprintf(
                'Не найдена запись в EAV-таблице. catalogEntityId: %d, catalogAttributeId: %d, valueId: %d',
                $catalogEntityId,
                $catalogAttributeId,
                $valueId
            ));
        }
    }
    
}
