<?php declare(strict_types = 1);

namespace modules\domains\modules\image_type\models;

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
 * @property int    $eavId
 * @property int    $valueId
 * @property string $file
 * @property int    $height
 * @property int    $width
 * @property int    $size
 * @property int    $type
 * @property int    $numGroup
 * @property int    $catalogAttributeId
 * @property int    $catalogEntityId
 */
class ImageTypeDataView extends BaseTable
{
    
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%v_img_type_data}}';
    }
    
}
