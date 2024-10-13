<?php declare(strict_types = 1);

namespace modules\domains\modules\value\models;

use modules\domains\BaseTable;

/**
 * This is the model class for table "value_image".
 *
 * @property int    $id         ИД
 * @property string $file       Наименование файла, где хранится изображение
 * @property int    $height     Высота изображения
 * @property int    $width      Ширина изображения
 * @property int    $size       Размер файла, КБ
 * @property string $ext        Расширение файла
 * @property int    $type       Тип изображения ('catalog', 'wm', 'card')
 * @property int    $numGroup
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
            [['isDelete'], 'integer'],
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
            'isDelete' => 'Признак удаления',
        ];
    }
    
}
