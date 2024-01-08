<?php declare(strict_types = 1);

namespace modules\domains\modules\value\models;

use modules\domains\BaseTable;
use modules\domains\modules\dictionary\models\DictionaryTable;
use modules\domains\modules\type_value\models\TypeValueTable;
use modules\domains\modules\unit\models\UnitTable;
use yii\db\ActiveQueryInterface;

/**
 * This is the model class for table "eav".
 *
 * @property int    $id                           ИД
 * @property int    entityId                      ИД продукта
 * @property int    catalogAttributeId            ИД связи каталог-атрибут
 * @property int    valueId                       Ид значения
 * @property string $createdAt                    Дата создания
 * @property string $updatedAt                    Дата обновления
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
