<?php declare(strict_types = 1);

namespace modules\domains\modules\value\models;

use modules\domains\BaseTable;

/**
 * This is the model class for table "value".
 *
 * @property int    $id                  ИД
 * @property int    $typeValueId         ИД типа значения
 * @property string $createdAt           Дата создания
 * @property string $updatedAt           Дата обновления
 */
class ValueTable extends BaseTable
{
    
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%value}}';
    }
    
}
