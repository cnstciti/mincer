<?php declare(strict_types = 1);

namespace modules\domains\modules\catalog\models;

use modules\domains\BaseTable;
use yii\db\ActiveQueryInterface;

/**
 * This is the model class for table "catalog".
 *
 * @property int    $id                 ИД
 * @property int    $parentId           ИД родителя
 * @property string $name               Наименование
 * @property string $prefixEntity       Префиксв сущности
 * @property string $formatEntity       Формат полного имени сущности
 * @property int    $isEndItem          Признак листа дерева
 * @property int    $isDelete           Признак удаления
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
            'id'           => 'ИД',
            'parentId'     => 'Родительский каталог',
            'name'         => 'Наименование',
            'prefixEntity' => 'Префикс сущности',
            'formatEntity' => 'Формат полного имени сущности',
            'isEndItem'    => 'Признак конечного узла',
            'isDelete'     => 'Признак удаления',
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
