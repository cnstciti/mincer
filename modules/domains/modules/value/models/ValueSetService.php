<?php declare(strict_types = 1);

namespace modules\domains\modules\value\models;

use Exception;
use modules\domains\Module;

class ValueSetService
{
    
    /**
     * сохранение
     *
     * @param int $id
     * @param int $dictionaryContentId
     */
    public static function insert(int $id, int $dictionaryContentId): void
    {
        // TODO переделать через DI
        $t                      = new ValueSetTable;
        $t->id                  = $id;
        $t->dictionaryContentId = $dictionaryContentId;
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
              ->truncateTable(ValueSetTable::tableName())
              ->execute();
    }
    
    public static function getModel(int $valueId): ValueSetTable
    {
        return ValueSetTable::findOne($valueId) ?? new ValueSetTable;
    }
    
}
