<?php

use yii\db\Migration;

/**
 * Class m241006_082213_init_catalog_attribute_table
 */
class m241006_082213_init_catalog_attribute_table extends Migration
{
    private const TABLE_NAME = '{{%catalog_attribute}}';
    
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        /** @lang MySQL */
        $query = <<<QUERY
INSERT INTO catalog_attribute (id, `catalogId`, `attributeId`, `createdAt`, `updatedAt`) VALUES(2, 4, 2, '2024-06-29 19:11:06.000', '2024-06-29 19:11:06.000');
INSERT INTO catalog_attribute (id, `catalogId`, `attributeId`, `createdAt`, `updatedAt`) VALUES(3, 4, 3, '2024-06-29 19:11:28.000', '2024-06-29 19:11:28.000');
INSERT INTO catalog_attribute (id, `catalogId`, `attributeId`, `createdAt`, `updatedAt`) VALUES(4, 4, 4, '2024-06-29 19:16:24.000', '2024-06-29 19:16:24.000');
INSERT INTO catalog_attribute (id, `catalogId`, `attributeId`, `createdAt`, `updatedAt`) VALUES(5, 4, 5, '2024-06-29 19:16:47.000', '2024-06-29 19:16:47.000');
INSERT INTO catalog_attribute (id, `catalogId`, `attributeId`, `createdAt`, `updatedAt`) VALUES(6, 4, 6, '2024-06-29 19:17:05.000', '2024-06-29 19:17:05.000');
INSERT INTO catalog_attribute (id, `catalogId`, `attributeId`, `createdAt`, `updatedAt`) VALUES(7, 4, 7, '2024-06-29 19:17:29.000', '2024-06-29 19:17:29.000');
INSERT INTO catalog_attribute (id, `catalogId`, `attributeId`, `createdAt`, `updatedAt`) VALUES(8, 4, 8, '2024-06-29 19:17:56.000', '2024-06-29 19:17:56.000');
INSERT INTO catalog_attribute (id, `catalogId`, `attributeId`, `createdAt`, `updatedAt`) VALUES(9, 4, 9, '2024-06-29 19:18:24.000', '2024-06-29 19:18:24.000');
INSERT INTO catalog_attribute (id, `catalogId`, `attributeId`, `createdAt`, `updatedAt`) VALUES(10, 4, 10, '2024-06-29 19:18:59.000', '2024-06-29 19:18:59.000');
INSERT INTO catalog_attribute (id, `catalogId`, `attributeId`, `createdAt`, `updatedAt`) VALUES(11, 4, 11, '2024-06-29 19:31:18.000', '2024-06-29 19:31:18.000');
INSERT INTO catalog_attribute (id, `catalogId`, `attributeId`, `createdAt`, `updatedAt`) VALUES(12, 4, 12, '2024-06-29 19:34:24.000', '2024-06-29 19:34:24.000');
INSERT INTO catalog_attribute (id, `catalogId`, `attributeId`, `createdAt`, `updatedAt`) VALUES(13, 4, 13, '2024-06-29 19:35:03.000', '2024-06-29 19:35:03.000');
INSERT INTO catalog_attribute (id, `catalogId`, `attributeId`, `createdAt`, `updatedAt`) VALUES(14, 4, 14, '2024-06-29 19:35:37.000', '2024-06-29 19:35:37.000');
INSERT INTO catalog_attribute (id, `catalogId`, `attributeId`, `createdAt`, `updatedAt`) VALUES(15, 4, 15, '2024-06-29 19:36:39.000', '2024-06-29 19:36:39.000');
INSERT INTO catalog_attribute (id, `catalogId`, `attributeId`, `createdAt`, `updatedAt`) VALUES(16, 4, 16, '2024-06-29 20:00:57.000', '2024-06-29 20:00:57.000');
INSERT INTO catalog_attribute (id, `catalogId`, `attributeId`, `createdAt`, `updatedAt`) VALUES(17, 4, 17, '2024-06-29 20:01:20.000', '2024-06-29 20:01:20.000');
INSERT INTO catalog_attribute (id, `catalogId`, `attributeId`, `createdAt`, `updatedAt`) VALUES(18, 4, 18, '2024-06-29 20:01:46.000', '2024-06-29 20:01:46.000');
INSERT INTO catalog_attribute (id, `catalogId`, `attributeId`, `createdAt`, `updatedAt`) VALUES(19, 4, 19, '2024-06-29 20:02:14.000', '2024-06-29 20:02:14.000');
INSERT INTO catalog_attribute (id, `catalogId`, `attributeId`, `createdAt`, `updatedAt`) VALUES(20, 4, 20, '2024-06-29 20:02:50.000', '2024-06-29 20:02:50.000');
INSERT INTO catalog_attribute (id, `catalogId`, `attributeId`, `createdAt`, `updatedAt`) VALUES(21, 4, 21, '2024-06-29 20:03:21.000', '2024-06-29 20:03:21.000');
INSERT INTO catalog_attribute (id, `catalogId`, `attributeId`, `createdAt`, `updatedAt`) VALUES(22, 4, 22, '2024-06-29 20:03:47.000', '2024-06-29 20:03:47.000');
INSERT INTO catalog_attribute (id, `catalogId`, `attributeId`, `createdAt`, `updatedAt`) VALUES(23, 4, 23, '2024-06-30 08:45:37.000', '2024-06-30 08:45:37.000');
INSERT INTO catalog_attribute (id, `catalogId`, `attributeId`, `createdAt`, `updatedAt`) VALUES(24, 4, 24, '2024-06-30 08:46:13.000', '2024-06-30 08:46:13.000');
INSERT INTO catalog_attribute (id, `catalogId`, `attributeId`, `createdAt`, `updatedAt`) VALUES(25, 4, 25, '2024-06-30 10:38:34.000', '2024-06-30 10:38:34.000');
INSERT INTO catalog_attribute (id, `catalogId`, `attributeId`, `createdAt`, `updatedAt`) VALUES(26, 4, 26, '2024-07-23 09:46:39.000', '2024-07-23 09:46:39.000');
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
