<?php declare(strict_types = 1);

namespace frontend\models\parser_simple_type;

use modules\domains\BaseTable;

/**
 * This is the model class for table "v_simple_type_data".
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
class ParserSimpleTypeDataView extends BaseTable
{
    
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%v_parser_value_view}}';
    }
    
}
