<?php declare(strict_types = 1);

namespace modules\domains\modules\value_int\models;

use Exception;
use modules\domains\BaseTable;
use modules\domains\modules\values\models\IValueModel;
use Throwable;

/**
 * This is the model class for table "value_int".
 *
 * @property int    $id                  ИД
 * @property int    $value               Значение
 * @property string $createdAt           Дата создания
 * @property string $updatedAt           Дата обновления
 */
class ValueIntTable extends BaseTable implements IValueModel
{
    
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%value_int}}';
    }
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['value'], 'required'],
            [['value'], 'integer'],
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
            $t        = new ValueIntTable;
            $t->id    = $valueId;
            $t->value = intval($value);
            $t->save();
        } catch (Throwable $e) {
            throw new Exception('Ошибка при создании ValueIntTable. ' . $e->getMessage());
        }
    }
    
    /**
     * {@inheritdoc}
     */
    public function computeValue(): int
    {
        return intval($this[$this->getValueName()]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function getValueName(): string
    {
        return 'value';
    }
    
}
