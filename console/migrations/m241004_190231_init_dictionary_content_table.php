<?php

use yii\db\Migration;

/**
 * Class m241004_190231_init_dictionary_content_table
 */
class m241004_190231_init_dictionary_content_table extends Migration
{
    private const TABLE_NAME = '{{%dictionary_content}}';
    
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        /** @lang MySQL */
        $query = <<<QUERY
INSERT INTO dictionary_content (id, `dictionaryId`, value, `createdAt`, `updatedAt`) VALUES(1, 9, 'да','2024-06-29 19:26:14.000', '2024-06-29 19:26:14.000');
INSERT INTO dictionary_content (id, `dictionaryId`, value, `createdAt`, `updatedAt`) VALUES(2, 9, 'нет','2024-06-29 19:26:21.000', '2024-06-29 19:26:21.000');
INSERT INTO dictionary_content (id, `dictionaryId`, value, `createdAt`, `updatedAt`) VALUES(3, 2, 'Катод','2024-06-30 10:20:19.000', '2024-06-30 10:20:19.000');
INSERT INTO dictionary_content (id, `dictionaryId`, value, `createdAt`, `updatedAt`) VALUES(4, 12, '6СТ-62N L+ (L2)','2024-06-30 10:24:11.000', '2024-07-23 09:43:55.000');
INSERT INTO dictionary_content (id, `dictionaryId`, value, `createdAt`, `updatedAt`) VALUES(5, 6, 'кальциевый (Ca/Ca)','2024-06-30 10:31:14.000', '2024-06-30 10:31:14.000');
INSERT INTO dictionary_content (id, `dictionaryId`, value, `createdAt`, `updatedAt`) VALUES(6, 7, 'для легкового автомобиля','2024-06-30 10:33:25.000', '2024-06-30 10:33:25.000');
INSERT INTO dictionary_content (id, `dictionaryId`, value, `createdAt`, `updatedAt`) VALUES(7, 3, 'прямая','2024-06-30 10:34:03.000', '2024-06-30 10:34:03.000');
INSERT INTO dictionary_content (id, `dictionaryId`, value, `createdAt`, `updatedAt`) VALUES(8, 4, '12','2024-06-30 10:34:44.000', '2024-06-30 10:34:44.000');
INSERT INTO dictionary_content (id, `dictionaryId`, value, `createdAt`, `updatedAt`) VALUES(9, 13, 'европейский','2024-06-30 10:37:00.000', '2024-06-30 10:37:00.000');
INSERT INTO dictionary_content (id, `dictionaryId`, value, `createdAt`, `updatedAt`) VALUES(10, 5, 'стандартные','2024-06-30 10:39:30.000', '2024-06-30 10:39:30.000');
INSERT INTO dictionary_content (id, `dictionaryId`, value, `createdAt`, `updatedAt`) VALUES(11, 8, 'частично обслуживаемый','2024-06-30 10:40:33.000', '2024-06-30 10:40:33.000');
INSERT INTO dictionary_content (id, `dictionaryId`, value, `createdAt`, `updatedAt`) VALUES(12, 1, 'Россия','2024-06-30 11:08:50.000', '2024-06-30 11:08:50.000');
INSERT INTO dictionary_content (id, `dictionaryId`, value, `createdAt`, `updatedAt`) VALUES(13, 12, '6СТ-62N R+ (L2)','2024-07-01 18:22:15.000', '2024-07-23 09:44:04.000');
INSERT INTO dictionary_content (id, `dictionaryId`, value, `createdAt`, `updatedAt`) VALUES(14, 3, 'обратная','2024-07-01 18:26:48.000', '2024-07-01 18:26:48.000');
INSERT INTO dictionary_content (id, `dictionaryId`, value, `createdAt`, `updatedAt`) VALUES(15, 12, '6СТ-60N R+ (L2)','2024-07-02 19:17:15.000', '2024-07-23 09:44:11.000');
INSERT INTO dictionary_content (id, `dictionaryId`, value, `createdAt`, `updatedAt`) VALUES(16, 12, '6СТ-60N L+ (L2)','2024-07-22 15:51:26.000', '2024-07-23 09:44:20.000');
INSERT INTO dictionary_content (id, `dictionaryId`, value, `createdAt`, `updatedAt`) VALUES(17, 12, '6СТ-74N L+ (L3)','2024-07-22 17:07:19.000', '2024-07-23 09:44:29.000');
INSERT INTO dictionary_content (id, `dictionaryId`, value, `createdAt`, `updatedAt`) VALUES(18, 12, '6СТ-74N R+ (L3)','2024-07-22 22:42:56.000', '2024-07-23 09:44:38.000');
INSERT INTO dictionary_content (id, `dictionaryId`, value, `createdAt`, `updatedAt`) VALUES(19, 12, '6СТ-90N L+ (L5)','2024-07-22 23:18:28.000', '2024-07-23 09:44:47.000');
INSERT INTO dictionary_content (id, `dictionaryId`, value, `createdAt`, `updatedAt`) VALUES(20, 12, '6СТ-90N R+ (L5)','2024-07-23 08:18:20.000', '2024-07-23 09:44:56.000');
INSERT INTO dictionary_content (id, `dictionaryId`, value, `createdAt`, `updatedAt`) VALUES(21, 14, 'Extra Start','2024-07-23 09:43:26.000', '2024-07-23 09:43:26.000');
INSERT INTO dictionary_content (id, `dictionaryId`, value, `createdAt`, `updatedAt`) VALUES(22, 12, '6СТ-100N L+ (L5)','2024-07-28 11:17:54.000', '2024-07-28 11:17:54.000');
INSERT INTO dictionary_content (id, `dictionaryId`, value, `createdAt`, `updatedAt`) VALUES(23, 12, '6СТ-100N R+ (L5)','2024-07-30 22:57:26.000', '2024-07-30 22:57:26.000');
INSERT INTO dictionary_content (id, `dictionaryId`, value, `createdAt`, `updatedAt`) VALUES(24, 12, '6СТ-110N R+ (L5)','2024-07-30 23:09:12.000', '2024-07-30 23:21:57.000');
INSERT INTO dictionary_content (id, `dictionaryId`, value, `createdAt`, `updatedAt`) VALUES(25, 12, '6СТ-110N L+ (L5)','2024-08-24 22:02:43.000', '2024-08-24 22:02:43.000');
INSERT INTO dictionary_content (id, `dictionaryId`, value, `createdAt`, `updatedAt`) VALUES(26, 12, '6СТ-140N L+ (A)','2024-09-09 22:28:37.000', '2024-09-09 22:28:37.000');
INSERT INTO dictionary_content (id, `dictionaryId`, value, `createdAt`, `updatedAt`) VALUES(27, 7, 'для грузового автомобиля','2024-09-09 22:29:23.000', '2024-09-09 22:29:23.000');
INSERT INTO dictionary_content (id, `dictionaryId`, value, `createdAt`, `updatedAt`) VALUES(28, 8, 'необслуживаемый','2024-09-09 22:33:57.000', '2024-09-09 22:33:57.000');
INSERT INTO dictionary_content (id, `dictionaryId`, value, `createdAt`, `updatedAt`) VALUES(29, 12, '6СТ-140N R+ (A)','2024-09-15 22:10:28.000', '2024-09-15 22:10:28.000');
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
