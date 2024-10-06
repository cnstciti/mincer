<?php declare(strict_types = 1);

namespace modules\domains\modules\attribute\models;

use modules\domains\BaseTable;
use modules\domains\modules\dictionary\models\DictionaryTable;
use modules\domains\modules\type_value\models\TypeValueTable;
use modules\domains\modules\unit\models\UnitTable;
use yii\db\ActiveQueryInterface;

/**
 * This is the model class for table "attribute".
 *
 * @property int    $id                  ИД
 * @property int    $unitId              ИД единицы измерения
 * @property int    $dictionaryId        ИД словаря
 * @property int    $typeValueId         ИД типа значения
 * @property string $name                Наименование
 * @property string $description         Описание
 * @property string $createdAt           Дата создания
 * @property string $updatedAt           Дата обновления
 */
class AttributeTable extends BaseTable
{
    
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%attribute}}';
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'           => 'ИД',
            'unitId'       => 'Единица измерения',
            'dictionaryId' => 'Словарь',
            'typeValueId'  => 'Тип значения',
            'name'         => 'Наименование',
            'description'  => 'Описание',
            //'isDelete'     => 'Признак удаления атрибута',
        ];
    }
    
    /**
     * @return ActiveQueryInterface
     */
    public function getUnit(): ActiveQueryInterface
    {
        return $this->hasOne(UnitTable::class, ['id' => 'unitId']);
    }
    
    /**
     * @return ActiveQueryInterface
     */
    public function getDictionary(): ActiveQueryInterface
    {
        return $this->hasOne(DictionaryTable::class, ['id' => 'dictionaryId']);
    }
    
    /**
     * @return ActiveQueryInterface
     */
    public function getType(): ActiveQueryInterface
    {
        return $this->hasOne(TypeValueTable::class, ['id' => 'typeValueId']);
    }

}
