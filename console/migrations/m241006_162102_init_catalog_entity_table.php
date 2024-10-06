<?php

use yii\db\Migration;

/**
 * Class m241006_162102_init_catalog_entity_table
 */
class m241006_162102_init_catalog_entity_table extends Migration
{
    private const TABLE_NAME = '{{%catalog_entity}}';
    
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        /** @lang MySQL */
        $query = <<<QUERY
INSERT INTO catalog_entity (id, `catalogId`, `entityId`, `createdAt`, `updatedAt`) VALUES(1, 4, 1, '2024-06-30 08:54:05.000', '2024-06-30 08:54:05.000');
INSERT INTO catalog_entity (id, `catalogId`, `entityId`, `createdAt`, `updatedAt`) VALUES(2, 4, 2, '2024-07-01 18:17:50.000', '2024-07-01 18:17:50.000');
INSERT INTO catalog_entity (id, `catalogId`, `entityId`, `createdAt`, `updatedAt`) VALUES(3, 4, 3, '2024-07-02 18:44:24.000', '2024-07-02 18:44:24.000');
INSERT INTO catalog_entity (id, `catalogId`, `entityId`, `createdAt`, `updatedAt`) VALUES(4, 4, 4, '2024-07-22 15:48:21.000', '2024-07-22 15:48:21.000');
INSERT INTO catalog_entity (id, `catalogId`, `entityId`, `createdAt`, `updatedAt`) VALUES(5, 4, 5, '2024-07-22 17:05:45.000', '2024-07-22 17:05:45.000');
INSERT INTO catalog_entity (id, `catalogId`, `entityId`, `createdAt`, `updatedAt`) VALUES(6, 4, 6, '2024-07-22 22:40:17.000', '2024-07-22 22:40:17.000');
INSERT INTO catalog_entity (id, `catalogId`, `entityId`, `createdAt`, `updatedAt`) VALUES(7, 4, 7, '2024-07-22 23:17:00.000', '2024-07-22 23:17:00.000');
INSERT INTO catalog_entity (id, `catalogId`, `entityId`, `createdAt`, `updatedAt`) VALUES(8, 4, 8, '2024-07-23 08:17:06.000', '2024-07-23 08:17:06.000');
INSERT INTO catalog_entity (id, `catalogId`, `entityId`, `createdAt`, `updatedAt`) VALUES(9, 4, 9, '2024-07-28 11:16:10.000', '2024-07-28 11:16:10.000');
INSERT INTO catalog_entity (id, `catalogId`, `entityId`, `createdAt`, `updatedAt`) VALUES(10, 4, 10, '2024-07-30 22:56:33.000', '2024-07-30 22:56:33.000');
INSERT INTO catalog_entity (id, `catalogId`, `entityId`, `createdAt`, `updatedAt`) VALUES(11, 4, 11, '2024-07-30 23:05:54.000', '2024-07-30 23:05:54.000');
INSERT INTO catalog_entity (id, `catalogId`, `entityId`, `createdAt`, `updatedAt`) VALUES(12, 4, 12, '2024-08-24 21:59:42.000', '2024-08-24 21:59:42.000');
INSERT INTO catalog_entity (id, `catalogId`, `entityId`, `createdAt`, `updatedAt`) VALUES(13, 4, 13, '2024-09-09 22:21:59.000', '2024-09-09 22:21:59.000');
INSERT INTO catalog_entity (id, `catalogId`, `entityId`, `createdAt`, `updatedAt`) VALUES(14, 4, 14, '2024-09-15 22:08:31.000', '2024-09-15 22:08:31.000');
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
