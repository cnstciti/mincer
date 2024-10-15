<?php declare(strict_types = 1);

namespace modules\domains\modules\value_image\models;

use Exception;
use modules\domains\BaseTable;
use Throwable;

/**
 * This is the model class for table "value_image".
 *
 * @property int    $id         ИД
 * @property string $file       Наименование файла, где хранится изображение
 * @property int    $height     Высота изображения
 * @property int    $width      Ширина изображения
 * @property int    $size       Размер файла, КБ
 * @property int    $type       Тип изображения ('catalog', 'wm', 'card')
 * @property int    $numGroup   Группировка одного изображения
 * @property int    $isDelete   Признак удаления
 * @property string $createdAt  Дата создания
 * @property string $updatedAt  Дата обновления
 */
class ValueImageTable extends BaseTable
{
    
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%value_image}}';
    }
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpeg, jpg', 'maxFiles' => 20],
            //[['isDelete'], 'integer'],
            //[['file'], 'required'],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'file'     => 'Файл изображения',
        ];
    }
    
    /**
     * @param int $valueId
     * @param     $value
     * @throws Exception
     */
    public function insertValueObject(int $valueId, $value): void
    {
        try {
            $t        = new ValueImageTable;
            $t->id    = $valueId;
            $t->value = intval($value);
            $t->save();
        } catch (Throwable $e) {
            throw new Exception('Ошибка при создании ValueImageTable. ' . $e->getMessage());
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
