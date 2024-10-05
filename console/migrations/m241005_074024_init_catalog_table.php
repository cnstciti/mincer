<?php

use yii\db\Migration;

/**
 * Class m241005_074024_init_catalog_table
 */
class m241005_074024_init_catalog_table extends Migration
{
    private const TABLE_NAME = '{{%catalog}}';
    
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        /** @lang MySQL */
        $query = <<<QUERY
INSERT INTO catalog (id, `parentId`, name, `containsProducts`, `createdAt`, `updatedAt`) VALUES(1, 1, 'root', 0, '2024-06-29 18:44:32.000', '2024-06-29 18:44:36.000');
INSERT INTO catalog (id, `parentId`, name, `containsProducts`, `createdAt`, `updatedAt`) VALUES(2, 1, 'Транспортные средства', 0, '2024-06-29 18:45:46.000', '2024-06-30 08:49:26.000');
INSERT INTO catalog (id, `parentId`, name, `containsProducts`, `createdAt`, `updatedAt`) VALUES(3, 2, 'Аккумуляторы и аксессуары', 0, '2024-06-29 18:52:16.000', '2024-06-29 18:52:16.000');
INSERT INTO catalog (id, `parentId`, name, `containsProducts`, `createdAt`, `updatedAt`) VALUES(4, 3, 'Аккумуляторы автомобильные', 1, '2024-06-29 18:53:02.000', '2024-06-29 18:53:02.000');
INSERT INTO catalog (id, `parentId`, name, `containsProducts`, `createdAt`, `updatedAt`) VALUES(7, 2, 'Колёса', 0, '2024-06-30 08:50:46.000', '2024-06-30 08:50:46.000');
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
