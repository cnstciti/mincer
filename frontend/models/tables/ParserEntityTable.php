<?php declare(strict_types = 1);

namespace frontend\models\tables;

use modules\domains\modules\catalog\models\CatalogTable;
use modules\domains\modules\entity\models\EntityTable;
use yii\db\ActiveQueryInterface;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "parser_site".
 *
 * @property int    $id           ИД
 * @property string $name         Наименование
 * @property int    $catalogId    ИД каталога
 * @property int    $entityId     ИД продукта
 * @property int    $parserSiteId ИД сайта-донора
 * @property string $status       Статус
 * @property string $createdAt    Дата создания
 */
class ParserEntityTable extends ActiveRecord
{
    
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%parser_entity}}';
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'        => 'ИД',
            'name'      => 'Наименование',
            'catalogId' => 'Каталог',
        ];
    }
    
    /**
     * @return ActiveQueryInterface
     */
    public function getCatalog(): ActiveQueryInterface
    {
        return $this->hasOne(CatalogTable::class, ['id' => 'catalogId']);
    }
    
    /**
     * @return ActiveQueryInterface
     */
    public function getEntity(): ActiveQueryInterface
    {
        return $this->hasOne(EntityTable::class, ['id' => 'entityId']);
    }
    
    /**
     * @return ActiveQueryInterface
     */
    public function getSite(): ActiveQueryInterface
    {
        return $this->hasOne(ParserSiteTable::class, ['id' => 'parserSiteId']);
    }
    
}
