<?php declare(strict_types = 1);

namespace modules\domains\modules\set_type\models;

use modules\domains\BaseTable;

/**
 * This is the model class for table "v_set_type_data".
 *
 * @property int    $catalogId
 * @property string $catalogName
 * @property int    $entityId
 * @property string $entityName
 * @property int    $attributeId
 * @property string $attributeName
 * @property int    $typeId
 * @property string $typeName
 * @property int    $unitId
 * @property string $unitName
 * @property int    $dictionaryId
 * @property string $dictionaryName
 * @property int    $eavId
 * @property int    $valueId
 * @property string $value
 * @property int    $catalogAttributeId
 * @property int    $catalogEntityId
 */
class SetTypeDataView extends BaseTable
{
    
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%v_set_type_data}}';
    }
    
}
