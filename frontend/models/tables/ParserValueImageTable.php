<?php declare(strict_types = 1);

namespace frontend\models\tables;

use modules\domains\modules\attribute\models\AttributeTable;
use yii\db\ActiveQueryInterface;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "parser_value_image".
 *
 * @property int    $id        ИД
 * @property string $dir       Путь файла
 * @property string $fileName  Наименование файла
 * @property string $extension Расширение файла
 * @property int    $height    Высота изображения
 * @property int    $width     Ширина изображения
 * @property int    $size      Размер файла, КБ
 * @property int    $status    Статус
 * @property string $createdAt Дата создания
 */
class ParserValueImageTable extends ActiveRecord
{
    
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%parser_value_image}}';
    }
    
    /**
     * {@inheritdoc}
     * /
    public function attributeLabels()
    {
        return [
            'id'          => 'ИД',
            'name'        => 'Наименование',
            'attributeId' => 'Базовый атрибут',
            'status'      => 'Статус',
            'dictionaryContentId'      => 'Содержимое словаря',
        ];
    }
    
    /**
     * @return ActiveQueryInterface
     *
     * public function getAttr(): ActiveQueryInterface
     * {
     * return $this->hasOne(AttributeTable::class, ['id' => 'attributeId']);
     * }
     *
     * /**
     * @return ActiveQueryInterface
     * /
     * public function getEntity(): ActiveQueryInterface
     * {
     * return $this->hasOne(EntityTable::class, ['id' => 'entityId']);
     * }
     *
     * /**
     * @return ActiveQueryInterface
     * /
     * public function getSite(): ActiveQueryInterface
     * {
     * return $this->hasOne(ParserSiteTable::class, ['id' => 'parserSiteId']);
     * }
     */
}
