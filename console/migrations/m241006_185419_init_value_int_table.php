<?php

use yii\db\Migration;

/**
 * Class m241006_185419_init_value_int_table
 */
class m241006_185419_init_value_int_table extends Migration
{
    private const TABLE_NAME = '{{%value_int}}';
    
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        /** @lang MySQL */
        $query = <<<QUERY
INSERT INTO value_int (id, value, `createdAt`, `updatedAt`) VALUES(5, 190, '2024-06-30 10:28:16.000', '2024-06-30 10:28:16.000');
INSERT INTO value_int (id, value, `createdAt`, `updatedAt`) VALUES(6, 175, '2024-06-30 10:28:31.000', '2024-06-30 10:28:31.000');
INSERT INTO value_int (id, value, `createdAt`, `updatedAt`) VALUES(7, 242, '2024-06-30 10:28:46.000', '2024-06-30 10:28:46.000');
INSERT INTO value_int (id, value, `createdAt`, `updatedAt`) VALUES(8, 62, '2024-06-30 10:29:06.000', '2024-06-30 10:29:06.000');
INSERT INTO value_int (id, value, `createdAt`, `updatedAt`) VALUES(9, 580, '2024-06-30 10:29:26.000', '2024-06-30 10:29:26.000');
INSERT INTO value_int (id, value, `createdAt`, `updatedAt`) VALUES(10, 36, '2024-06-30 10:29:43.000', '2024-06-30 10:29:43.000');
INSERT INTO value_int (id, value, `createdAt`, `updatedAt`) VALUES(39, 60, '2024-07-02 19:18:47.000', '2024-07-02 19:18:47.000');
INSERT INTO value_int (id, value, `createdAt`, `updatedAt`) VALUES(40, 540, '2024-07-02 19:19:12.000', '2024-07-02 19:19:12.000');
INSERT INTO value_int (id, value, `createdAt`, `updatedAt`) VALUES(68, 278, '2024-07-22 17:08:44.000', '2024-07-22 17:08:44.000');
INSERT INTO value_int (id, value, `createdAt`, `updatedAt`) VALUES(69, 74, '2024-07-22 17:09:05.000', '2024-07-22 17:09:05.000');
INSERT INTO value_int (id, value, `createdAt`, `updatedAt`) VALUES(70, 680, '2024-07-22 17:09:25.000', '2024-07-22 17:09:25.000');
INSERT INTO value_int (id, value, `createdAt`, `updatedAt`) VALUES(88, 353, '2024-07-22 23:20:17.000', '2024-07-22 23:20:17.000');
INSERT INTO value_int (id, value, `createdAt`, `updatedAt`) VALUES(89, 90, '2024-07-22 23:20:32.000', '2024-07-22 23:20:32.000');
INSERT INTO value_int (id, value, `createdAt`, `updatedAt`) VALUES(90, 720, '2024-07-22 23:20:46.000', '2024-07-22 23:20:46.000');
INSERT INTO value_int (id, value, `createdAt`, `updatedAt`) VALUES(106, 100, '2024-07-28 11:19:03.000', '2024-07-28 11:19:03.000');
INSERT INTO value_int (id, value, `createdAt`, `updatedAt`) VALUES(107, 800, '2024-07-28 11:19:19.000', '2024-07-28 11:19:19.000');
INSERT INTO value_int (id, value, `createdAt`, `updatedAt`) VALUES(118, 1000, '2024-07-30 23:10:28.000', '2024-07-30 23:10:28.000');
INSERT INTO value_int (id, value, `createdAt`, `updatedAt`) VALUES(120, 110, '2024-07-30 23:22:38.000', '2024-07-30 23:22:38.000');
INSERT INTO value_int (id, value, `createdAt`, `updatedAt`) VALUES(121, 950, '2024-07-30 23:27:34.000', '2024-07-30 23:27:34.000');
INSERT INTO value_int (id, value, `createdAt`, `updatedAt`) VALUES(137, 223, '2024-09-09 22:25:42.000', '2024-09-09 22:25:42.000');
INSERT INTO value_int (id, value, `createdAt`, `updatedAt`) VALUES(138, 12, '2024-09-09 22:27:14.000', '2024-09-09 22:27:14.000');
INSERT INTO value_int (id, value, `createdAt`, `updatedAt`) VALUES(139, 513, '2024-09-09 22:27:31.000', '2024-09-09 22:27:31.000');
INSERT INTO value_int (id, value, `createdAt`, `updatedAt`) VALUES(140, 140, '2024-09-09 22:27:46.000', '2024-09-09 22:27:46.000');
INSERT INTO value_int (id, value, `createdAt`, `updatedAt`) VALUES(143, 920, '2024-09-09 22:30:29.000', '2024-09-09 22:30:29.000');
INSERT INTO value_int (id, value, `createdAt`, `updatedAt`) VALUES(144, 189, '2024-09-09 22:30:52.000', '2024-09-09 22:30:52.000');
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
