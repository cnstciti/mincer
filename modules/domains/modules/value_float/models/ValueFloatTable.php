<?php declare(strict_types = 1);

namespace modules\domains\modules\value_float\models;

use Exception;
use modules\domains\BaseTable;
use modules\domains\modules\values\models\IValueModel;
use Throwable;

/**
 * This is the model class for table "value_float".
 *
 * @property int    $id                  ИД
 * @property int    $value               Значение
 * @property string $createdAt           Дата создания
 * @property string $updatedAt           Дата обновления
 */
class ValueFloatTable extends BaseTable implements IValueModel
{
    
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%value_float}}';
    }
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['value'], 'required'],
            [['value'], 'number'],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'value' => 'Значение',
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function insertValueObject(int $valueId, $value): void
    {
        try {
            $t        = new ValueFloatTable;
            $t->id    = $valueId;
            $t->value = intval($value);
            $t->save();
        } catch (Throwable $e) {
            throw new Exception('Ошибка при создании ValueFloatTable. ' . $e->getMessage());
        }
    }
    
    /**
     * {@inheritdoc}
     */
    public function computeValue(): float
    {
        return floatval($this[$this->getValueName()]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function getValueName(): string
    {
        return 'value';
    }
    
}
