<?php

use yii\db\Migration;

/**
 * Class m241006_161726_init_entity_table
 */
class m241006_161726_init_entity_table extends Migration
{
    private const TABLE_NAME = '{{%entity}}';
    
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        /** @lang MySQL */
        $query = <<<QUERY
INSERT INTO entity (id, name, `createdAt`, `updatedAt`) VALUES(1, 'Аккумулятор автомобильный КАТОД EXTRA START Extra Start 62Ач 580A [6ст-62n l+ (l2)]','2024-06-30 08:54:05.000', '2024-06-30 08:54:05.000');
INSERT INTO entity (id, name, `createdAt`, `updatedAt`) VALUES(2, 'Аккумулятор автомобильный КАТОД EXTRA START Extra Start 62Ач 580A [6ст-62n r+ (l2)]','2024-07-01 18:17:50.000', '2024-07-01 18:17:50.000');
INSERT INTO entity (id, name, `createdAt`, `updatedAt`) VALUES(3, 'Аккумулятор автомобильный КАТОД EXTRA START Extra Start 60Ач 540A [6ст-60n r+ (l2)]','2024-07-02 18:44:24.000', '2024-07-02 18:44:24.000');
INSERT INTO entity (id, name, `createdAt`, `updatedAt`) VALUES(4, 'Аккумулятор автомобильный КАТОД EXTRA START Extra Start 60Ач 540A [6ст-60n l+ (l2)]','2024-07-22 15:48:21.000', '2024-07-22 15:48:21.000');
INSERT INTO entity (id, name, `createdAt`, `updatedAt`) VALUES(5, 'Аккумулятор автомобильный КАТОД EXTRA START Extra Start 74Ач 680A [6ст-74n l+ (l3)]','2024-07-22 17:05:44.000', '2024-07-22 22:41:46.000');
INSERT INTO entity (id, name, `createdAt`, `updatedAt`) VALUES(6, 'Аккумулятор автомобильный КАТОД EXTRA START Extra Start 74Ач 680A [6ст-74n r+ (l3)]','2024-07-22 22:40:17.000', '2024-07-22 22:40:17.000');
INSERT INTO entity (id, name, `createdAt`, `updatedAt`) VALUES(7, 'Аккумулятор автомобильный КАТОД EXTRA START Extra Start 90Ач 720A [6ст-90n l+ (l5)]','2024-07-22 23:16:59.000', '2024-07-22 23:16:59.000');
INSERT INTO entity (id, name, `createdAt`, `updatedAt`) VALUES(8, 'Аккумулятор автомобильный КАТОД EXTRA START Extra Start 90Ач 720A [6ст-90n r+ (l5)]','2024-07-23 08:17:06.000', '2024-07-23 08:17:06.000');
INSERT INTO entity (id, name, `createdAt`, `updatedAt`) VALUES(9, 'Аккумулятор автомобильный КАТОД EXTRA START Extra Start 100Ач 800A [6ст-100n l+ (l5)]','2024-07-28 11:16:10.000', '2024-07-28 11:16:10.000');
INSERT INTO entity (id, name, `createdAt`, `updatedAt`) VALUES(10, 'Аккумулятор автомобильный КАТОД EXTRA START Extra Start 100Ач 800A [6ст-100n r+ (l5)]','2024-07-30 22:56:33.000', '2024-07-30 22:56:33.000');
INSERT INTO entity (id, name, `createdAt`, `updatedAt`) VALUES(11, 'Аккумулятор автомобильный КАТОД EXTRA START Extra Start 110Ач 950A [6ст-110n r+ (l5)]','2024-07-30 23:05:54.000', '2024-07-30 23:30:37.000');
INSERT INTO entity (id, name, `createdAt`, `updatedAt`) VALUES(12, 'Аккумулятор автомобильный КАТОД EXTRA START Extra Start 110Ач 950A [6ст-110n l+ (l5)]','2024-08-24 21:59:16.000', '2024-08-24 21:59:16.000');
INSERT INTO entity (id, name, `createdAt`, `updatedAt`) VALUES(13, 'Аккумулятор автомобильный КАТОД EXTRA START Extra Start 140Ач 920A [6СТ-140N L+ (A)]','2024-09-09 22:21:59.000', '2024-09-15 22:08:42.000');
INSERT INTO entity (id, name, `createdAt`, `updatedAt`) VALUES(14, 'Аккумулятор автомобильный КАТОД EXTRA START Extra Start 140Ач 920A [6СТ-140N R+ (A)]','2024-09-15 22:08:31.000', '2024-09-15 22:08:31.000');
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
