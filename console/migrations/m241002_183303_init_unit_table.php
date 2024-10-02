<?php

use yii\db\Migration;

/**
 * Class m241002_183303_init_unit_table
 */
class m241002_183303_init_unit_table extends Migration
{
    private const TABLE_NAME = '{{%unit}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $query = <<<QUERY
INSERT INTO unit
(id, name, `shortName`, `createdAt`, `updatedAt`)
VALUES(1, 'Миллиметр', 'мм', '2024-06-29 19:13:22.000', '2024-06-29 19:13:22.000');
INSERT INTO unit
(id, name, `shortName`, `createdAt`, `updatedAt`)
VALUES(2, 'Килограмм', 'кг', '2024-06-29 19:14:12.000', '2024-06-29 19:14:12.000');
INSERT INTO unit
(id, name, `shortName`, `createdAt`, `updatedAt`)
VALUES(3, 'Месяц', 'мес', '2024-06-29 19:15:13.000', '2024-06-29 19:15:13.000');
INSERT INTO unit
(id, name, `shortName`, `createdAt`, `updatedAt`)
VALUES(4, 'Ампер', 'А', '2024-06-29 19:27:03.000', '2024-06-29 19:27:03.000');
INSERT INTO unit
(id, name, `shortName`, `createdAt`, `updatedAt`)
VALUES(5, 'Ампер-час', 'А.ч', '2024-06-29 19:27:30.000', '2024-06-29 19:27:30.000');
INSERT INTO unit
(id, name, `shortName`, `createdAt`, `updatedAt`)
VALUES(6, 'Вольт', 'В', '2024-06-29 19:27:56.000', '2024-06-29 19:27:56.000');
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
