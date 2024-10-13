<?php declare(strict_types = 1);

namespace modules\domains\modules\value_enum\models;

use Exception;
use modules\domains\BaseTable;
use modules\domains\modules\values\models\IValueModel;
use Throwable;

/**
 * This is the model class for table "value_enum".
 *
 * @property int    $id                  ИД
 * @property int    $value               Значение
 * @property string $createdAt           Дата создания
 * @property string $updatedAt           Дата обновления
 */
class ValueEnumTable extends BaseTable implements IValueModel
{
    
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%value_enum}}';
    }
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dictionaryContentId'], 'required'],
            [['dictionaryContentId'], 'integer'],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'dictionaryContentId' => 'Значение',
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function insertValueObject(int $id, $dictionaryContentId): void
    {
        try {
            $t                      = new ValueEnumTable;
            $t->id                  = $id;
            $t->dictionaryContentId = $dictionaryContentId;
        } catch (Throwable $e) {
            throw new Exception('Ошибка при создании ValueEnumTable. ' . $e->getMessage());
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
        return 'dictionaryContentId';
    }
    
}
