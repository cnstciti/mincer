<?php declare(strict_types = 1);

namespace modules\domains\modules\value_string\models;

use Exception;
use modules\domains\BaseTable;
use modules\domains\modules\values\models\IValueModel;
use Throwable;

/**
 * This is the model class for table "value_string".
 *
 * @property int    $id                  ИД
 * @property int    $value               Значение
 * @property string $createdAt           Дата создания
 * @property string $updatedAt           Дата обновления
 */
class ValueStringTable extends BaseTable implements IValueModel
{
    
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%value_string}}';
    }
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['value'], 'required'],
            [['value'], 'string'],
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
            $t        = new ValueStringTable;
            $t->id    = $valueId;
            $t->value = intval($value);
            $t->save();
        } catch (Throwable $e) {
            throw new Exception('Ошибка при создании ValueStringTable. ' . $e->getMessage());
        }
    }
    
    /**
     * {@inheritdoc}
     */
    public function computeValue(): string
    {
        return strval($this[$this->getValueName()]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function getValueName(): string
    {
        return 'value';
    }
    
}
