<?php declare(strict_types = 1);

namespace modules\domains\modules\value\models;

use modules\domains\BaseTable;

/**
 * This is the model class for table "value_int".
 *
 * @property int    $id                  ИД
 * @property int    $value               Значение
 * @property string $createdAt           Дата создания
 * @property string $updatedAt           Дата обновления
 */
class ValueIntTable extends BaseTable
{
    
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%value_int}}';
    }
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['value'], 'required'],
            [['value'], 'integer'],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'value' => 'Значение',
        ];
    }
    
}
