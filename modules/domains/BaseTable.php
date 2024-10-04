<?php declare(strict_types = 1);

namespace modules\domains;

use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Connection;

class BaseTable extends ActiveRecord
{
    
    /**
     * @return Connection
     * @throws \Exception
     */
    public static function getDb(): Connection
    {
        return Module::getInstance()->getDb();
    }
    
    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        /*
        return [
            /*[
                'class' => SluggableBehavior::class,
                'attribute' => 'message',
                'immutable' => true,
                'ensureUnique'=>true,
            ],* /
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                //'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['createdAt', 'updatedAt'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updatedAt'],
                ],
            ],
        ];
        */

        return [
            [
                'class'              => TimestampBehavior::class,
                'attributes' => [
                    static::EVENT_BEFORE_INSERT => ['createdAt', 'updatedAt'],
                    static::EVENT_BEFORE_UPDATE => ['updatedAt'],
                ],
                //'createdAtAttribute' => 'createdAt',
                //'updatedAtAttribute' => 'updatedAt',
                'value'              => date('Y-m-d H:i:s'),
            ],
        ];
    }
    
    /**
     * Последний (максимальный) ИД
     * @return int
     */
    public static function lastId(): int
    {
        return static::find()->max('id');
    }
    
}
