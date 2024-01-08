<?php declare(strict_types = 1);

namespace modules\domains\modules\value\models;

use Exception;
use modules\domains\Module as BaseModule;

class ValueFloatService
{
    
    /**
     * сохранение
     *
     * @param int $id
     * @param float $value
     */
    public static function insert(int $id, float $value): void
    {
        // TODO переделать через DI
        $t        = new ValueFloatTable;
        $t->id    = $id;
        $t->value = $value;
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
        BaseModule::getInstance()
              ->getDb()
              ->createCommand()
              ->truncateTable(ValueFloatTable::tableName())
              ->execute();
    }
    
    public static function getModel(int $valueId): ValueFloatTable
    {
        return ValueFloatTable::findOne($valueId) ?? new ValueFloatTable;
    }
    
}
