<?php

use yii\db\Migration;

/**
 * Class m241004_173529_init_dictionary_table
 */
class m241004_173529_init_dictionary_table extends Migration
{
    private const TABLE_NAME = '{{%dictionary}}';
    
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $query = <<<QUERY
INSERT INTO dictionary
(id, name, `createdAt`, `updatedAt`)
VALUES(1, 'Страна производителя', '2024-06-29 19:15:44.000', '2024-06-29 19:15:44.000');
INSERT INTO dictionary
(id, name, `createdAt`, `updatedAt`)
VALUES(2, 'Бренд (Аккумуляторы автомобильные)', '2024-06-29 19:22:05.000', '2024-06-29 19:23:09.000');
INSERT INTO dictionary
(id, name, `createdAt`, `updatedAt`)
VALUES(3, 'Полярность (Аккумуляторы автомобильные)', '2024-06-29 19:23:26.000', '2024-06-29 19:24:39.000');
INSERT INTO dictionary
(id, name, `createdAt`, `updatedAt`)
VALUES(4, 'Напряжение (Аккумуляторы автомобильные)', '2024-06-29 19:23:33.000', '2024-06-29 19:25:06.000');
INSERT INTO dictionary
(id, name, `createdAt`, `updatedAt`)
VALUES(5, 'Клеммы (Аккумуляторы автомобильные)', '2024-06-29 19:23:41.000', '2024-06-29 19:25:12.000');
INSERT INTO dictionary
(id, name, `createdAt`, `updatedAt`)
VALUES(6, 'Технология аккумулятора', '2024-06-29 19:23:49.000', '2024-06-29 19:23:49.000');
INSERT INTO dictionary
(id, name, `createdAt`, `updatedAt`)
VALUES(7, 'Назначение (Аккумуляторы автомобильные)', '2024-06-29 19:24:15.000', '2024-06-29 19:25:20.000');
INSERT INTO dictionary
(id, name, `createdAt`, `updatedAt`)
VALUES(8, 'Обслуживание (Аккумуляторы автомобильные)', '2024-06-29 19:24:29.000', '2024-06-29 19:25:29.000');
INSERT INTO dictionary
(id, name, `createdAt`, `updatedAt`)
VALUES(9, 'Булевский тип', '2024-06-29 19:25:59.000', '2024-06-29 19:25:59.000');
INSERT INTO dictionary
(id, name, `createdAt`, `updatedAt`)
VALUES(10, 'Пусковой ток (Аккумуляторы автомобильные)', '2024-06-29 19:32:39.000', '2024-06-29 19:32:58.000');
INSERT INTO dictionary
(id, name, `createdAt`, `updatedAt`)
VALUES(11, 'Ёмкость (Аккумуляторы автомобильные)', '2024-06-29 19:32:47.000', '2024-06-29 19:33:06.000');
INSERT INTO dictionary
(id, name, `createdAt`, `updatedAt`)
VALUES(12, 'Марка (Аккумуляторы автомобильные)', '2024-06-30 08:45:07.000', '2024-06-30 08:45:07.000');
INSERT INTO dictionary
(id, name, `createdAt`, `updatedAt`)
VALUES(13, 'Типоразмер (Аккумуляторы автомобильные)', '2024-06-30 10:36:31.000', '2024-06-30 10:36:42.000');
INSERT INTO dictionary
(id, name, `createdAt`, `updatedAt`)
VALUES(14, 'Модель (Аккумуляторы автомобильные)', '2024-07-23 09:42:58.000', '2024-07-23 09:42:58.000');
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
