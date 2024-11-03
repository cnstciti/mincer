<?php declare(strict_types = 1);

namespace frontend\models\parser_image_type;

use modules\domains\BaseTable;

/**
 * This is the model class for table "v_parser_img_view".
 *
 * @property int    $parserEntityId
 * @property string $parserEntityName
 * @property int    $isBaseEntity
 * @property int    $entityId
 * @property int    $imgId
 * @property string $dir
 * @property string $fileName
 * @property string $extension
 * @property int    $height
 * @property int    $width
 * @property int    $size
 * @property string $imgStatus
 * @property int    $typeId
 */
class ParserImageTypeDataView extends BaseTable
{
    
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%v_parser_img_view}}';
    }
    
}
