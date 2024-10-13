<?php

use yii\db\Migration;

/**
 * Class m241006_201112_init_value_enum_table
 */
class m241006_201112_init_value_enum_table extends Migration
{
    private const TABLE_NAME = '{{%value_enum}}';
    
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        /** @lang MySQL */
        $query = <<<QUERY
INSERT INTO value_enum (id, `dictionaryContentId`, `createdAt`, `updatedAt`) VALUES(1, 3, '2024-06-30 10:24:32.000', '2024-06-30 10:24:32.000');
INSERT INTO value_enum (id, `dictionaryContentId`, `createdAt`, `updatedAt`) VALUES(2, 4, '2024-06-30 10:24:44.000', '2024-06-30 10:24:44.000');
INSERT INTO value_enum (id, `dictionaryContentId`, `createdAt`, `updatedAt`) VALUES(11, 5, '2024-06-30 10:31:28.000', '2024-06-30 10:31:28.000');
INSERT INTO value_enum (id, `dictionaryContentId`, `createdAt`, `updatedAt`) VALUES(12, 6, '2024-06-30 10:33:37.000', '2024-06-30 10:33:37.000');
INSERT INTO value_enum (id, `dictionaryContentId`, `createdAt`, `updatedAt`) VALUES(13, 7, '2024-06-30 10:34:17.000', '2024-06-30 10:34:17.000');
INSERT INTO value_enum (id, `dictionaryContentId`, `createdAt`, `updatedAt`) VALUES(14, 8, '2024-06-30 10:34:52.000', '2024-06-30 10:34:52.000');
INSERT INTO value_enum (id, `dictionaryContentId`, `createdAt`, `updatedAt`) VALUES(15, 9, '2024-06-30 10:38:53.000', '2024-06-30 10:38:53.000');
INSERT INTO value_enum (id, `dictionaryContentId`, `createdAt`, `updatedAt`) VALUES(16, 10, '2024-06-30 10:39:39.000', '2024-06-30 10:39:39.000');
INSERT INTO value_enum (id, `dictionaryContentId`, `createdAt`, `updatedAt`) VALUES(17, 2, '2024-06-30 10:40:04.000', '2024-06-30 10:40:04.000');
INSERT INTO value_enum (id, `dictionaryContentId`, `createdAt`, `updatedAt`) VALUES(18, 11, '2024-06-30 10:40:40.000', '2024-06-30 10:40:40.000');
INSERT INTO value_enum (id, `dictionaryContentId`, `createdAt`, `updatedAt`) VALUES(20, 12, '2024-06-30 11:08:58.000', '2024-06-30 11:08:58.000');
INSERT INTO value_enum (id, `dictionaryContentId`, `createdAt`, `updatedAt`) VALUES(27, 13, '2024-07-01 18:22:48.000', '2024-07-01 18:22:48.000');
INSERT INTO value_enum (id, `dictionaryContentId`, `createdAt`, `updatedAt`) VALUES(29, 14, '2024-07-01 18:26:54.000', '2024-07-01 18:26:54.000');
INSERT INTO value_enum (id, `dictionaryContentId`, `createdAt`, `updatedAt`) VALUES(37, 15, '2024-07-02 19:17:36.000', '2024-07-02 19:17:36.000');
INSERT INTO value_enum (id, `dictionaryContentId`, `createdAt`, `updatedAt`) VALUES(54, 16, '2024-07-22 15:51:57.000', '2024-07-22 15:51:57.000');
INSERT INTO value_enum (id, `dictionaryContentId`, `createdAt`, `updatedAt`) VALUES(64, 1, '2024-07-22 16:29:48.000', '2024-07-22 16:29:48.000');
INSERT INTO value_enum (id, `dictionaryContentId`, `createdAt`, `updatedAt`) VALUES(66, 17, '2024-07-22 17:07:55.000', '2024-07-22 17:07:55.000');
INSERT INTO value_enum (id, `dictionaryContentId`, `createdAt`, `updatedAt`) VALUES(77, 18, '2024-07-22 22:43:38.000', '2024-07-22 22:43:38.000');
INSERT INTO value_enum (id, `dictionaryContentId`, `createdAt`, `updatedAt`) VALUES(86, 19, '2024-07-22 23:19:21.000', '2024-07-22 23:19:21.000');
INSERT INTO value_enum (id, `dictionaryContentId`, `createdAt`, `updatedAt`) VALUES(94, 20, '2024-07-23 08:18:50.000', '2024-07-23 08:18:50.000');
INSERT INTO value_enum (id, `dictionaryContentId`, `createdAt`, `updatedAt`) VALUES(102, 21, '2024-07-23 09:47:20.000', '2024-07-23 09:47:20.000');
INSERT INTO value_enum (id, `dictionaryContentId`, `createdAt`, `updatedAt`) VALUES(104, 22, '2024-07-28 11:18:09.000', '2024-07-28 11:18:09.000');
INSERT INTO value_enum (id, `dictionaryContentId`, `createdAt`, `updatedAt`) VALUES(111, 23, '2024-07-30 22:57:44.000', '2024-07-30 22:57:44.000');
INSERT INTO value_enum (id, `dictionaryContentId`, `createdAt`, `updatedAt`) VALUES(117, 24, '2024-07-30 23:09:29.000', '2024-07-30 23:09:29.000');
INSERT INTO value_enum (id, `dictionaryContentId`, `createdAt`, `updatedAt`) VALUES(131, 25, '2024-08-24 22:02:59.000', '2024-08-24 22:02:59.000');
INSERT INTO value_enum (id, `dictionaryContentId`, `createdAt`, `updatedAt`) VALUES(141, 26, '2024-09-09 22:28:52.000', '2024-09-09 22:28:52.000');
INSERT INTO value_enum (id, `dictionaryContentId`, `createdAt`, `updatedAt`) VALUES(142, 27, '2024-09-09 22:29:32.000', '2024-09-09 22:29:32.000');
INSERT INTO value_enum (id, `dictionaryContentId`, `createdAt`, `updatedAt`) VALUES(145, 28, '2024-09-09 22:34:03.000', '2024-09-09 22:34:03.000');
INSERT INTO value_enum (id, `dictionaryContentId`, `createdAt`, `updatedAt`) VALUES(150, 29, '2024-09-15 22:10:41.000', '2024-09-15 22:10:41.000');
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
