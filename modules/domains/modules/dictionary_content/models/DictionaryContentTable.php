<?php declare(strict_types = 1);

namespace modules\domains\modules\dictionary_content\models;

use modules\domains\BaseTable;

/**
 * This is the model class for table "dictionary_content".
 *
 * @property int    $id                  ИД
 * @property int    $dictionaryId        ИД словаря
 * @property string $value               Наименование
 * @property string $createdAt           Дата создания
 * @property string $updatedAt           Дата обновления
 */
class DictionaryContentTable extends BaseTable
{
    
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%dictionary_content}}';
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'       => 'ИД',
            'value'    => 'Содержание словаря',
            //'isDelete' => 'Признак удаления',
        ];
    }
    
}
