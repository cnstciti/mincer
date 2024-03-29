<?php declare(strict_types = 1);

namespace modules\domains\modules\value\models;

use modules\domains\BaseTable;

/**
 * This is the model class for table "value_set".
 *
 * @property int    $id                    ИД
 * @property int    $dictionaryContentId   ИД на содержание словаря
 * @property string $createdAt             Дата создания
 * @property string $updatedAt             Дата обновления
 */
class ValueSetTable extends BaseTable
{
    
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%value_set}}';
    }
    
}
