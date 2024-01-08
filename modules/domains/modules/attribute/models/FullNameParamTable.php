<?php declare(strict_types = 1);

namespace modules\domains\modules\attribute\models;

use modules\domains\BaseTable;


/**
 * This is the model class for table "full_name_param".
 *
 * @property int    $id                          ИД
 * @property int    $sequenceNumber              ИД каталога
 * @property string $createdAt                   Дата создания
 * @property string $updatedAt                   Дата обновления
 */
class FullNameParamTable extends BaseTable
{
    
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%full_name_param}}';
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sequenceNumber' => 'Порядковый номер атрибута',
        ];
    }
    
}
