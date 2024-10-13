<?php declare(strict_types = 1);

namespace modules\domains\modules\eav\models;

use modules\domains\BaseTable;

/**
 * This is the model class for table "eav".
 *
 * @property int    $id                     ИД
 * @property int    $catalogEntityId        ИД связи каталог-продукт (catalog_entity)
 * @property int    $catalogAttributeId     ИД связи каталог-атрибут (catalog_attribute)
 * @property int    $valueId                ИД связи значения (value)
 * @property string $createdAt              Дата создания
 * @property string $updatedAt              Дата обновления
 */
class EavTable extends BaseTable
{
    
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%eav}}';
    }
    
}
