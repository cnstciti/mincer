<?php declare(strict_types = 1);

namespace frontend\models\tables;

use modules\domains\modules\attribute\models\AttributeTable;
use yii\db\ActiveQueryInterface;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "parser_attribute".
 *
 * @property int    $id             ИД
 * @property string $name           Наименование
 * @property int    $attributeId    ИД атрибута
 * @property string $status         Статус
 * @property string $createdAt      Дата создания
 */
class ParserAttributeTable extends ActiveRecord
{
    
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%parser_attribute}}';
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'          => 'ИД',
            'name'        => 'Наименование',
            'attributeId' => 'Базовый атрибут',
            'status'      => 'Статус',
        ];
    }
    
    /**
     * @return ActiveQueryInterface
     */
    public function getAttr(): ActiveQueryInterface
    {
        return $this->hasOne(AttributeTable::class, ['id' => 'attributeId']);
    }
    
    /**
     * @return ActiveQueryInterface
     * /
    public function getEntity(): ActiveQueryInterface
    {
        return $this->hasOne(EntityTable::class, ['id' => 'entityId']);
    }
    
    /**
     * @return ActiveQueryInterface
     * /
    public function getSite(): ActiveQueryInterface
    {
        return $this->hasOne(ParserSiteTable::class, ['id' => 'parserSiteId']);
    }
    */
}
