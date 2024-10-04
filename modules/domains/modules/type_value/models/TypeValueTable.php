<?php declare(strict_types = 1);

namespace modules\domains\modules\type_value\models;

use modules\domains\BaseTable;

/**
 * This is the model class for table "type_value".
 *
 * @property int    $id        ИД
 * @property string $name      Наименование
 * @property string $createdAt Дата создания
 * @property string $updatedAt Дата обновления
 */
class TypeValueTable extends BaseTable
{
    
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%type_value}}';
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'       => 'ИД',
            'name'     => 'Наименование',
            //'isDelete' => 'Признак удаления',
        ];
    }
    
}
