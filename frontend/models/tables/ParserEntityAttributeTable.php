<?php declare(strict_types = 1);

namespace frontend\models\tables;

use yii\db\ActiveQueryInterface;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "parser_entity_attribute".
 *
 * @property int    $id                   ИД
 * @property int    $parserEntityId       ИД продукта
 * @property int    $parserAttributeId    ИД атрибута
 * @property string $createdAt            Дата создания
 */
class ParserEntityAttributeTable extends ActiveRecord
{
    
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%parser_entity_attribute}}';
    }
    
    /**
     * {@inheritdoc}
     * /
    public function attributeLabels()
    {
        return [
            'id'        => 'ИД',
            'name'      => 'Наименование',
            'catalogId' => 'Каталог',
            'entityId'     => 'Базовый продукт',
            'isBaseEntity' => 'Сделать продукт базовым?',
        ];
    }
    
    /**
     * @return ActiveQueryInterface
     * /
    public function getCatalog(): ActiveQueryInterface
    {
        return $this->hasOne(CatalogTable::class, ['id' => 'catalogId']);
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
