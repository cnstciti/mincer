<?php declare(strict_types = 1);

namespace modules\domains\modules\value\models;

use Exception;
use modules\domains\Module as BaseModule;

class ValueIntService
{
    
    /**
     * сохранение
     *
     * @param ValueIntTable $t
     * @param int $id
     * @param int $value
     */
    public static function insert(ValueIntTable $t, int $id, int $value): void
    {
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
              ->truncateTable(ValueIntTable::tableName())
              ->execute();
    }
    
    public static function getModel(int $valueId): ValueIntTable
    {
        return ValueIntTable::findOne($valueId) ?? new ValueIntTable;
    }
    
}
