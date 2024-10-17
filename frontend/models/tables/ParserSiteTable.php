<?php declare(strict_types = 1);

namespace frontend\models\tables;

use yii\db\ActiveQueryInterface;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "parser_site".
 *
 * @property int    $id        ИД
 * @property string $name      Наименование
 * @property string $createdAt Дата создания
 */
class ParserSiteTable extends ActiveRecord
{
    
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%parser_site}}';
    }
    
    /**
     * @return ActiveQueryInterface
     */
    public function getEntities(): ActiveQueryInterface
    {
        return $this->hasMany(ParserEntityTable::class, ['parserSiteId' => 'id']);
    }
}
