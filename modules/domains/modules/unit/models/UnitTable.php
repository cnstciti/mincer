<?php declare(strict_types = 1);

namespace modules\domains\modules\unit\models;

use modules\domains\BaseTable;

/**
 * This is the model class for table "unit".
 *
 * @property int    $id        ИД
 * @property string $name      Наименование
 * @property string $shortName Короткое наименование
 * @property string $createdAt Дата создания
 * @property string $updatedAt Дата обновления
 */
class UnitTable extends BaseTable
{
    
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%unit}}';
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'        => 'ИД',
            'name'      => 'Наименование',
            'shortName' => 'Короткое наименование',
            //'isDelete'  => 'Признак удаления',
        ];
    }
    
}
