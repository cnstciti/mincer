<?php declare(strict_types = 1);

namespace modules\domains\modules\entity\models;

use modules\domains\BaseTable;
use modules\domains\modules\dictionary\models\DictionaryTable;
use modules\domains\modules\type_value\models\TypeValueTable;
use modules\domains\modules\unit\models\UnitTable;
use yii\db\ActiveQueryInterface;

/**
 * This is the model class for table "entity".
 *
 * @property int    $id                     ИД
 * @property string $name                   Наименование
 * @property string $fullName               Описание
 * @property int    $isDelete               Признак удаления
 * @property string $createdAt              Дата создания
 * @property string $updatedAt              Дата обновления
 */
class EntityTable extends BaseTable
{
    
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%entity}}';
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'       => 'ИД',
            'name'     => 'Наименование',
            'fullName' => 'Полное наименование',
            'isDelete' => 'Признак удаления',
        ];
    }
    
}
