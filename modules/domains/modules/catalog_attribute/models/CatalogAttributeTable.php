<?php declare(strict_types = 1);

namespace modules\domains\modules\catalog_attribute\models;

use modules\domains\BaseTable;

/**
 * This is the model class for table "catalog_attribute".
 *
 * @property int    $id                     ИД
 * @property int    $catalogId              ИД каталога
 * @property int    $attributeId            ИД атрибута
 * @property string $createdAt              Дата создания
 * @property string $updatedAt              Дата обновления
 */
class CatalogAttributeTable extends BaseTable
{
    
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%catalog_attribute}}';
    }
    
}
