<?php

use yii\db\Migration;

/**
 * Class m241006_080300_init_attribute_table
 */
class m241006_080300_init_attribute_table extends Migration
{
    private const TABLE_NAME = '{{%attribute}}';
    
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        /** @lang MySQL */
        $query = <<<QUERY
INSERT INTO attribute (id, `unitId`, `dictionaryId`, `typeValueId`, name, description, `createdAt`, `updatedAt`) VALUES(2, NULL, NULL, 4, 'Описание', 'Описание продукта','2024-06-29 19:11:06.000', '2024-06-29 19:11:06.000');
INSERT INTO attribute (id, `unitId`, `dictionaryId`, `typeValueId`, name, description, `createdAt`, `updatedAt`) VALUES(3, NULL, NULL, 3, 'Артикул производителя', 'Артикул производителя','2024-06-29 19:11:28.000', '2024-06-29 19:11:28.000');
INSERT INTO attribute (id, `unitId`, `dictionaryId`, `typeValueId`, name, description, `createdAt`, `updatedAt`) VALUES(4, 1, NULL, 1, 'Длина', 'Длина продукта','2024-06-29 19:16:24.000', '2024-06-29 19:16:24.000');
INSERT INTO attribute (id, `unitId`, `dictionaryId`, `typeValueId`, name, description, `createdAt`, `updatedAt`) VALUES(5, 1, NULL, 1, 'Ширина', 'Ширина продукта','2024-06-29 19:16:47.000', '2024-06-29 19:16:47.000');
INSERT INTO attribute (id, `unitId`, `dictionaryId`, `typeValueId`, name, description, `createdAt`, `updatedAt`) VALUES(6, 1, NULL, 1, 'Высота', 'Высота продукта','2024-06-29 19:17:05.000', '2024-06-29 19:17:05.000');
INSERT INTO attribute (id, `unitId`, `dictionaryId`, `typeValueId`, name, description, `createdAt`, `updatedAt`) VALUES(7, 2, NULL, 2, 'Вес', 'Вес продукта','2024-06-29 19:17:29.000', '2024-06-29 19:17:29.000');
INSERT INTO attribute (id, `unitId`, `dictionaryId`, `typeValueId`, name, description, `createdAt`, `updatedAt`) VALUES(8, 3, NULL, 1, 'Гарантийный срок', 'Гарантийный срок','2024-06-29 19:17:56.000', '2024-06-29 19:17:56.000');
INSERT INTO attribute (id, `unitId`, `dictionaryId`, `typeValueId`, name, description, `createdAt`, `updatedAt`) VALUES(9, 3, NULL, 1, 'Срок эксплуатации', 'Срок эксплуатации продукта','2024-06-29 19:18:24.000', '2024-06-29 19:18:24.000');
INSERT INTO attribute (id, `unitId`, `dictionaryId`, `typeValueId`, name, description, `createdAt`, `updatedAt`) VALUES(10, NULL, 1, 5, 'Страна производителя', 'Страна производителя продукта','2024-06-29 19:18:59.000', '2024-06-29 19:18:59.000');
INSERT INTO attribute (id, `unitId`, `dictionaryId`, `typeValueId`, name, description, `createdAt`, `updatedAt`) VALUES(11, NULL, 2, 5, 'Бренд', 'Бренд (Аккумуляторы автомобильные)','2024-06-29 19:31:18.000', '2024-06-29 19:31:37.000');
INSERT INTO attribute (id, `unitId`, `dictionaryId`, `typeValueId`, name, description, `createdAt`, `updatedAt`) VALUES(12, 4, 10, 1, 'Пусковой ток', 'Пусковой ток (Аккумуляторы автомобильные)','2024-06-29 19:34:24.000', '2024-06-29 19:34:24.000');
INSERT INTO attribute (id, `unitId`, `dictionaryId`, `typeValueId`, name, description, `createdAt`, `updatedAt`) VALUES(13, 5, 11, 1, 'Ёмкость', 'Ёмкость (Аккумуляторы автомобильные)','2024-06-29 19:35:03.000', '2024-06-29 19:35:03.000');
INSERT INTO attribute (id, `unitId`, `dictionaryId`, `typeValueId`, name, description, `createdAt`, `updatedAt`) VALUES(14, NULL, 3, 5, 'Полярность', 'Полярность (Аккумуляторы автомобильные)','2024-06-29 19:35:37.000', '2024-06-29 19:35:49.000');
INSERT INTO attribute (id, `unitId`, `dictionaryId`, `typeValueId`, name, description, `createdAt`, `updatedAt`) VALUES(15, 6, 4, 5, 'Напряжение', 'Напряжение (Аккумуляторы автомобильные)','2024-06-29 19:36:38.000', '2024-06-29 19:36:38.000');
INSERT INTO attribute (id, `unitId`, `dictionaryId`, `typeValueId`, name, description, `createdAt`, `updatedAt`) VALUES(16, NULL, 5, 5, 'Клеммы', 'Клеммы (Аккумуляторы автомобильные)','2024-06-29 20:00:56.000', '2024-06-29 20:00:56.000');
INSERT INTO attribute (id, `unitId`, `dictionaryId`, `typeValueId`, name, description, `createdAt`, `updatedAt`) VALUES(17, NULL, 6, 5, 'Технология аккумулятора', 'Технология аккумулятора','2024-06-29 20:01:20.000', '2024-06-29 20:01:20.000');
INSERT INTO attribute (id, `unitId`, `dictionaryId`, `typeValueId`, name, description, `createdAt`, `updatedAt`) VALUES(18, NULL, 7, 5, 'Назначение', 'Назначение (Аккумуляторы автомобильные)','2024-06-29 20:01:46.000', '2024-06-29 20:01:46.000');
INSERT INTO attribute (id, `unitId`, `dictionaryId`, `typeValueId`, name, description, `createdAt`, `updatedAt`) VALUES(19, NULL, 8, 5, 'Обслуживание', 'Обслуживание (Аккумуляторы автомобильные)','2024-06-29 20:02:14.000', '2024-06-29 20:02:14.000');
INSERT INTO attribute (id, `unitId`, `dictionaryId`, `typeValueId`, name, description, `createdAt`, `updatedAt`) VALUES(20, NULL, 9, 5, 'Индикатор заряда', 'Индикатор заряда (Аккумуляторы автомобильные)','2024-06-29 20:02:50.000', '2024-06-29 20:02:50.000');
INSERT INTO attribute (id, `unitId`, `dictionaryId`, `typeValueId`, name, description, `createdAt`, `updatedAt`) VALUES(21, NULL, 9, 5, 'Электролит в комплекте', 'Электролит в комплекте (Аккумуляторы автомобильные)','2024-06-29 20:03:21.000', '2024-06-29 20:03:21.000');
INSERT INTO attribute (id, `unitId`, `dictionaryId`, `typeValueId`, name, description, `createdAt`, `updatedAt`) VALUES(22, NULL, 9, 5, 'Поддержка системы "Старт-стоп"', 'Поддержка системы "Старт-стоп" (Аккумуляторы автомобильные)','2024-06-29 20:03:47.000', '2024-06-29 20:03:47.000');
INSERT INTO attribute (id, `unitId`, `dictionaryId`, `typeValueId`, name, description, `createdAt`, `updatedAt`) VALUES(23, NULL, 12, 5, 'Марка', 'Марка (Аккумуляторы автомобильные)','2024-06-30 08:45:37.000', '2024-06-30 08:45:37.000');
INSERT INTO attribute (id, `unitId`, `dictionaryId`, `typeValueId`, name, description, `createdAt`, `updatedAt`) VALUES(24, NULL, NULL, 7, 'Изображения', 'Изображения продукта','2024-06-30 08:46:13.000', '2024-06-30 08:46:13.000');
INSERT INTO attribute (id, `unitId`, `dictionaryId`, `typeValueId`, name, description, `createdAt`, `updatedAt`) VALUES(25, NULL, 13, 5, 'Типоразмер', 'Типоразмер (Аккумуляторы автомобильные)','2024-06-30 10:38:34.000', '2024-06-30 10:38:34.000');
INSERT INTO attribute (id, `unitId`, `dictionaryId`, `typeValueId`, name, description, `createdAt`, `updatedAt`) VALUES(26, NULL, 14, 5, 'Модель', 'Модель (Аккумуляторы автомобильные)','2024-07-23 09:46:39.000', '2024-07-23 09:46:39.000');
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
