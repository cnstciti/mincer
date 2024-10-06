<?php declare(strict_types = 1);

namespace modules\domains\modules\catalog_entity\models;

use modules\domains\BaseTable;

/**
 * This is the model class for table "catalog_entity".
 *
 * @property int    $id                     ИД
 * @property int    $catalogId              ИД каталога
 * @property int    $entityId               ИД продукта
 * @property string $createdAt              Дата создания
 * @property string $updatedAt              Дата обновления
 */
class CatalogEntityTable extends BaseTable
{
    
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%catalog_entity}}';
    }
    
}
