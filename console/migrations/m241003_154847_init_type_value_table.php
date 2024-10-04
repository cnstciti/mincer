<?php

use yii\db\Migration;

/**
 * Class m241003_154847_init_type_value_table
 */
class m241003_154847_init_type_value_table extends Migration
{
    private const TABLE_NAME = '{{%type_value}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $query = <<<QUERY
INSERT INTO type_value
(id, name, `createdAt`, `updatedAt`)
VALUES(1, 'int', '2024-06-29 19:08:13.000', '2024-06-29 19:08:13.000');
INSERT INTO type_value
(id, name, `createdAt`, `updatedAt`)
VALUES(2, 'float', '2024-06-29 19:08:24.000', '2024-06-29 19:08:24.000');
INSERT INTO type_value
(id, name, `createdAt`, `updatedAt`)
VALUES(3, 'string', '2024-06-29 19:08:34.000', '2024-06-29 19:08:34.000');
INSERT INTO type_value
(id, name, `createdAt`, `updatedAt`)
VALUES(4, 'text', '2024-06-29 19:08:43.000', '2024-06-29 19:08:43.000');
INSERT INTO type_value
(id, name, `createdAt`, `updatedAt`)
VALUES(5, 'enum', '2024-06-29 19:09:46.000', '2024-06-29 19:09:46.000');
INSERT INTO type_value
(id, name, `createdAt`, `updatedAt`)
VALUES(6, 'set', '2024-06-29 19:09:52.000', '2024-06-29 19:09:52.000');
INSERT INTO type_value
(id, name, `createdAt`, `updatedAt`)
VALUES(7, 'img', '2024-06-29 19:09:58.000', '2024-06-29 19:09:58.000');
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
