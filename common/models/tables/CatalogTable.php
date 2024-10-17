<?php declare(strict_types = 1);

namespace common\models\tables;

use yii\db\ActiveQueryInterface;

/**
 * This is the model class for table "catalog".
 *
 * @property int    $id                 ИД
 * @property int    $parentId           ИД родителя
 * @property string $name               Наименование
 * @property int    $containsProducts   Содержит товары или каталог верхнего уровня
 * @property string $createdAt          Дата создания
 * @property string $updatedAt          Дата обновления
 */
class CatalogTable extends BaseTable
{
    
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%catalog}}';
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'               => 'ИД',
            'parentId'         => 'Родительский каталог',
            'name'             => 'Наименование',
            'containsProducts' => 'Содержит товары',
        ];
    }
    
    /**
     * @return ActiveQueryInterface
     */
    public function getParent(): ActiveQueryInterface
    {
        return $this->hasOne(self::class, ['id' => 'parentId']);
    }
    
}
