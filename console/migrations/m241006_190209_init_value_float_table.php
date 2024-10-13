<?php

use yii\db\Migration;

/**
 * Class m241006_190209_init_value_float_table
 */
class m241006_190209_init_value_float_table extends Migration
{
    private const TABLE_NAME = '{{%value_float}}';
    
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        /** @lang MySQL */
        $query = <<<QUERY
INSERT INTO value_float (id, value, `createdAt`, `updatedAt`) VALUES(3, 14.000, '2024-06-30 10:26:48.000', '2024-06-30 10:26:48.000');
INSERT INTO value_float (id, value, `createdAt`, `updatedAt`) VALUES(36, 13.500, '2024-07-02 19:16:37.000', '2024-07-02 19:16:37.000');
INSERT INTO value_float (id, value, `createdAt`, `updatedAt`) VALUES(65, 17.000, '2024-07-22 17:06:57.000', '2024-07-22 17:06:57.000');
INSERT INTO value_float (id, value, `createdAt`, `updatedAt`) VALUES(85, 21.000, '2024-07-22 23:18:15.000', '2024-07-22 23:18:15.000');
INSERT INTO value_float (id, value, `createdAt`, `updatedAt`) VALUES(103, 24.000, '2024-07-28 11:16:57.000', '2024-07-28 11:16:57.000');
INSERT INTO value_float (id, value, `createdAt`, `updatedAt`) VALUES(136, 35.000, '2024-09-09 22:25:12.000', '2024-09-09 22:25:12.000');
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
