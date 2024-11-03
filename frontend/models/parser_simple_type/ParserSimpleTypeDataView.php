<?php declare(strict_types = 1);

namespace frontend\models\parser_simple_type;

use modules\domains\BaseTable;

/**
 * This is the model class for table "v_parser_value_view".
 *
 * @property int    $catalogId
 * @property string $catalogName
 * @property int    $parserEntityId
 * @property string $parserEntityName
 * @property int    $isBaseEntity
 * @property int    $entityId
 * @property string $entityName
 * @property int    $parserAttributeId
 * @property string $parserAttributeName
 * @property int    $attributeId
 * @property string $attributeName
 * @property int    $typeId
 * @property string $typeName
 * @property int    $unitId
 * @property string $unitName
 * @property int    $dictionaryId
 * @property string $dictionaryName
 * @property int    $valueId
 * @property string $meaning
 * @property int    $dictionaryContentId
 * @property string $dictionaryContentValue
 * @property int    $catalogAttributeId
 * @property int    $parserDictionaryContentId
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
