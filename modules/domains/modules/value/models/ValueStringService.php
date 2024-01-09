<?php declare(strict_types = 1);

namespace modules\domains\modules\value\models;

use Exception;
use modules\domains\Module as BaseModule;

class ValueStringService
{
    
    /**
     * сохранение
     *
     * @param int $id
     * @param string $value
     */
    public static function insert(int $id, string $value): void
    {
        // TODO переделать через DI
        $t        = new ValueStringTable;
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
              ->truncateTable(ValueStringTable::tableName())
              ->execute();
    }
    
    public static function getModel(int $valueId): ValueStringTable
    {
        return ValueStringTable::findOne($valueId) ?? new ValueStringTable;
    }
    
}
