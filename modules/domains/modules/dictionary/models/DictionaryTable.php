<?php declare(strict_types = 1);

namespace modules\domains\modules\dictionary\models;

use modules\domains\BaseTable;

/**
 * This is the model class for table "dictionary".
 *
 * @property int    $id        ИД
 * @property string $name      Наименование
 * @property string $createdAt Дата создания
 * @property string $updatedAt Дата обновления
 */
class DictionaryTable extends BaseTable
{
    
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%dictionary}}';
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
