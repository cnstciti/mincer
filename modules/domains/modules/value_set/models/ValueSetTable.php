<?php declare(strict_types = 1);

namespace modules\domains\modules\value_set\models;

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
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dictionaryContentId'], 'required'],
            [['dictionaryContentId'], 'integer'],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'dictionaryContentId' => 'Значение',
        ];
    }
    
}
