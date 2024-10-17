<?php declare(strict_types = 1);

namespace common\models\tables;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class BaseTable extends ActiveRecord
{
    
    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    static::EVENT_BEFORE_INSERT => ['createdAt', 'updatedAt'],
                    static::EVENT_BEFORE_UPDATE => ['updatedAt'],
                ],
                'value' => date('Y-m-d H:i:s'),
            ],
        ];
    }
    
    /**
     * Последний (максимальный) ИД
     * @return int
     */
    public static function maxId(): int
    {
        return static::find()->max('id');
    }
    
}
