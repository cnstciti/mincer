<?php

use yii\db\Migration;

/**
 * Class m241006_190534_init_value_string_table
 */
class m241006_190534_init_value_string_table extends Migration
{
    private const TABLE_NAME = '{{%value_string}}';
    
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        /** @lang MySQL */
        $query = <<<QUERY
INSERT INTO value_string (id, value, `createdAt`, `updatedAt`) VALUES(4, '6СТ-62NL', '2024-06-30 10:27:08.000', '2024-06-30 10:27:08.000');
INSERT INTO value_string (id, value, `createdAt`, `updatedAt`) VALUES(28, '6СТ-62NR', '2024-07-01 18:23:03.000', '2024-07-01 18:23:03.000');
INSERT INTO value_string (id, value, `createdAt`, `updatedAt`) VALUES(38, '6СТ-60NR', '2024-07-02 19:17:58.000', '2024-07-02 19:17:58.000');
INSERT INTO value_string (id, value, `createdAt`, `updatedAt`) VALUES(53, '6СТ-60NL', '2024-07-22 15:49:31.000', '2024-07-22 15:49:31.000');
INSERT INTO value_string (id, value, `createdAt`, `updatedAt`) VALUES(67, '6СТ-74NL', '2024-07-22 17:08:12.000', '2024-07-22 17:08:12.000');
INSERT INTO value_string (id, value, `createdAt`, `updatedAt`) VALUES(78, '6СТ-74NR', '2024-07-22 22:44:03.000', '2024-07-22 22:44:03.000');
INSERT INTO value_string (id, value, `createdAt`, `updatedAt`) VALUES(87, '6СТ-90NL', '2024-07-22 23:19:42.000', '2024-07-22 23:19:42.000');
INSERT INTO value_string (id, value, `createdAt`, `updatedAt`) VALUES(95, '6СТ-90NR', '2024-07-23 08:19:02.000', '2024-07-23 08:19:02.000');
INSERT INTO value_string (id, value, `createdAt`, `updatedAt`) VALUES(105, '6СТ-100NL', '2024-07-28 11:18:28.000', '2024-07-28 11:18:28.000');
INSERT INTO value_string (id, value, `createdAt`, `updatedAt`) VALUES(112, '6СТ-100NR', '2024-07-30 22:57:56.000', '2024-07-30 22:57:56.000');
INSERT INTO value_string (id, value, `createdAt`, `updatedAt`) VALUES(116, '6СТ-110NL', '2024-07-30 23:08:36.000', '2024-07-30 23:08:36.000');
INSERT INTO value_string (id, value, `createdAt`, `updatedAt`) VALUES(119, '6СТ-110NR', '2024-07-30 23:22:16.000', '2024-07-30 23:22:16.000');
INSERT INTO value_string (id, value, `createdAt`, `updatedAt`) VALUES(135, '6СТ-140NL', '2024-09-09 22:24:46.000', '2024-09-09 22:24:46.000');
INSERT INTO value_string (id, value, `createdAt`, `updatedAt`) VALUES(149, '6СТ-140NR', '2024-09-15 22:09:28.000', '2024-09-15 22:09:28.000');
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
