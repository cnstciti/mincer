<?php

use yii\db\Migration;

/**
 * Class m241006_201622_init_value_set_table
 */
class m241006_201622_init_value_set_table extends Migration
{
    private const TABLE_NAME = '{{%value_set}}';
    
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        /** @lang MySQL */
        $query = <<<QUERY
QUERY;
        $this->execute($query);
    }
    
    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->truncateTable(self::TABLE_NAME);
    }
}
