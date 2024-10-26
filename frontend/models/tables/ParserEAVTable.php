<?php declare(strict_types = 1);

namespace frontend\models\tables;

use yii\db\ActiveQueryInterface;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "parser_eav".
 *
 * @property int    $id                 ИД
 * @property int    $entityAttributeId  ИД связи Продукт - Атрибут
 * @property int    $valueId            ИД значения
 * @property string $createdAt          Дата создания
 */
class ParserEAVTable extends ActiveRecord
{
    
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%parser_eav}}';
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
