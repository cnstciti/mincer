<?php declare(strict_types = 1);

namespace modules\domains;

use Yii;
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
        if (isset(Module::getInstance()->params['db'])) {
            return Module::getInstance()->getDb();
        }

        return Yii::$app->db;
    }
    
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
    public static function lastId(): int
    {
        return static::find()->max('id');
    }
    
}
