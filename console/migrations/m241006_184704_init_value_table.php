<?php

use yii\db\Migration;

/**
 * Class m241006_184704_init_value_table
 */
class m241006_184704_init_value_table extends Migration
{
    private const TABLE_NAME = '{{%value}}';
    
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        /** @lang MySQL */
        $query = <<<QUERY
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(1, 5,'2024-06-30 10:24:32.000', '2024-06-30 10:24:32.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(2, 5,'2024-06-30 10:24:44.000', '2024-06-30 10:24:44.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(3, 2,'2024-06-30 10:26:48.000', '2024-06-30 10:26:48.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(4, 3,'2024-06-30 10:27:08.000', '2024-06-30 10:27:08.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(5, 1,'2024-06-30 10:28:16.000', '2024-06-30 10:28:16.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(6, 1,'2024-06-30 10:28:31.000', '2024-06-30 10:28:31.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(7, 1,'2024-06-30 10:28:46.000', '2024-06-30 10:28:46.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(8, 1,'2024-06-30 10:29:06.000', '2024-06-30 10:29:06.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(9, 1,'2024-06-30 10:29:26.000', '2024-06-30 10:29:26.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(10, 1,'2024-06-30 10:29:43.000', '2024-06-30 10:29:43.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(11, 5,'2024-06-30 10:31:28.000', '2024-06-30 10:31:28.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(12, 5,'2024-06-30 10:33:37.000', '2024-06-30 10:33:37.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(13, 5,'2024-06-30 10:34:17.000', '2024-06-30 10:34:17.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(14, 5,'2024-06-30 10:34:52.000', '2024-06-30 10:34:52.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(15, 5,'2024-06-30 10:38:53.000', '2024-06-30 10:38:53.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(16, 5,'2024-06-30 10:39:39.000', '2024-06-30 10:39:39.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(17, 5,'2024-06-30 10:40:04.000', '2024-06-30 10:40:04.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(18, 5,'2024-06-30 10:40:40.000', '2024-06-30 10:40:40.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(19, 4,'2024-06-30 11:03:08.000', '2024-06-30 11:03:08.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(20, 5,'2024-06-30 11:08:58.000', '2024-06-30 11:08:58.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(21, 7,'2024-06-30 12:08:20.000', '2024-06-30 12:08:20.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(22, 7,'2024-06-30 12:08:20.000', '2024-06-30 12:08:20.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(23, 7,'2024-06-30 12:08:20.000', '2024-06-30 12:08:20.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(24, 7,'2024-06-30 12:08:59.000', '2024-06-30 12:08:59.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(25, 7,'2024-06-30 12:08:59.000', '2024-06-30 12:08:59.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(26, 7,'2024-06-30 12:08:59.000', '2024-06-30 12:08:59.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(27, 5,'2024-07-01 18:22:48.000', '2024-07-01 18:22:48.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(28, 3,'2024-07-01 18:23:03.000', '2024-07-01 18:23:03.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(29, 5,'2024-07-01 18:26:54.000', '2024-07-01 18:26:54.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(30, 7,'2024-07-02 17:08:57.000', '2024-07-02 17:08:57.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(31, 7,'2024-07-02 17:08:57.000', '2024-07-02 17:08:57.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(32, 7,'2024-07-02 17:08:58.000', '2024-07-02 17:08:58.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(33, 7,'2024-07-02 17:09:11.000', '2024-07-02 17:09:11.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(34, 7,'2024-07-02 17:09:12.000', '2024-07-02 17:09:12.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(35, 7,'2024-07-02 17:09:12.000', '2024-07-02 17:09:12.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(36, 2,'2024-07-02 19:16:36.000', '2024-07-02 19:16:36.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(37, 5,'2024-07-02 19:17:36.000', '2024-07-02 19:17:36.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(38, 3,'2024-07-02 19:17:58.000', '2024-07-02 19:17:58.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(39, 1,'2024-07-02 19:18:47.000', '2024-07-02 19:18:47.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(40, 1,'2024-07-02 19:19:12.000', '2024-07-02 19:19:12.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(41, 7,'2024-07-02 19:27:35.000', '2024-07-02 19:27:35.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(42, 7,'2024-07-02 19:27:35.000', '2024-07-02 19:27:35.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(43, 7,'2024-07-02 19:27:36.000', '2024-07-02 19:27:36.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(44, 7,'2024-07-02 19:27:47.000', '2024-07-02 19:27:47.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(45, 7,'2024-07-02 19:27:48.000', '2024-07-02 19:27:48.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(46, 7,'2024-07-02 19:27:49.000', '2024-07-02 19:27:49.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(50, 7,'2024-07-02 19:29:31.000', '2024-07-02 19:29:31.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(51, 7,'2024-07-02 19:29:31.000', '2024-07-02 19:29:31.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(52, 7,'2024-07-02 19:29:31.000', '2024-07-02 19:29:31.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(53, 3,'2024-07-22 15:49:31.000', '2024-07-22 15:49:31.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(54, 5,'2024-07-22 15:51:57.000', '2024-07-22 15:51:57.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(55, 7,'2024-07-22 16:17:46.000', '2024-07-22 16:17:46.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(56, 7,'2024-07-22 16:17:46.000', '2024-07-22 16:17:46.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(57, 7,'2024-07-22 16:17:46.000', '2024-07-22 16:17:46.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(58, 7,'2024-07-22 16:18:02.000', '2024-07-22 16:18:02.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(59, 7,'2024-07-22 16:18:02.000', '2024-07-22 16:18:02.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(60, 7,'2024-07-22 16:18:02.000', '2024-07-22 16:18:02.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(61, 7,'2024-07-22 16:18:16.000', '2024-07-22 16:18:16.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(62, 7,'2024-07-22 16:18:17.000', '2024-07-22 16:18:17.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(63, 7,'2024-07-22 16:18:17.000', '2024-07-22 16:18:17.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(64, 5,'2024-07-22 16:29:48.000', '2024-07-22 16:29:48.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(65, 2,'2024-07-22 17:06:57.000', '2024-07-22 17:06:57.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(66, 5,'2024-07-22 17:07:55.000', '2024-07-22 17:07:55.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(67, 3,'2024-07-22 17:08:12.000', '2024-07-22 17:08:12.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(68, 1,'2024-07-22 17:08:44.000', '2024-07-22 17:08:44.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(69, 1,'2024-07-22 17:09:05.000', '2024-07-22 17:09:05.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(70, 1,'2024-07-22 17:09:25.000', '2024-07-22 17:09:25.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(71, 7,'2024-07-22 17:22:23.000', '2024-07-22 17:22:23.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(72, 7,'2024-07-22 17:22:24.000', '2024-07-22 17:22:24.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(73, 7,'2024-07-22 17:22:24.000', '2024-07-22 17:22:24.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(74, 7,'2024-07-22 17:22:45.000', '2024-07-22 17:22:45.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(75, 7,'2024-07-22 17:22:45.000', '2024-07-22 17:22:45.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(76, 7,'2024-07-22 17:22:46.000', '2024-07-22 17:22:46.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(77, 5,'2024-07-22 22:43:38.000', '2024-07-22 22:43:38.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(78, 3,'2024-07-22 22:44:03.000', '2024-07-22 22:44:03.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(82, 7,'2024-07-22 22:57:03.000', '2024-07-22 22:57:03.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(83, 7,'2024-07-22 22:57:03.000', '2024-07-22 22:57:03.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(84, 7,'2024-07-22 22:57:04.000', '2024-07-22 22:57:04.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(85, 2,'2024-07-22 23:18:15.000', '2024-07-22 23:18:15.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(86, 5,'2024-07-22 23:19:21.000', '2024-07-22 23:19:21.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(87, 3,'2024-07-22 23:19:42.000', '2024-07-22 23:19:42.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(88, 1,'2024-07-22 23:20:17.000', '2024-07-22 23:20:17.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(89, 1,'2024-07-22 23:20:32.000', '2024-07-22 23:20:32.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(90, 1,'2024-07-22 23:20:46.000', '2024-07-22 23:20:46.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(91, 7,'2024-07-22 23:29:09.000', '2024-07-22 23:29:09.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(92, 7,'2024-07-22 23:29:09.000', '2024-07-22 23:29:09.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(93, 7,'2024-07-22 23:29:09.000', '2024-07-22 23:29:09.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(94, 5,'2024-07-23 08:18:50.000', '2024-07-23 08:18:50.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(95, 3,'2024-07-23 08:19:02.000', '2024-07-23 08:19:02.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(96, 7,'2024-07-23 08:26:21.000', '2024-07-23 08:26:21.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(97, 7,'2024-07-23 08:26:21.000', '2024-07-23 08:26:21.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(98, 7,'2024-07-23 08:26:22.000', '2024-07-23 08:26:22.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(99, 7,'2024-07-23 08:26:36.000', '2024-07-23 08:26:36.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(100, 7,'2024-07-23 08:26:36.000', '2024-07-23 08:26:36.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(101, 7,'2024-07-23 08:26:36.000', '2024-07-23 08:26:36.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(102, 5,'2024-07-23 09:47:20.000', '2024-07-23 09:47:20.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(103, 2,'2024-07-28 11:16:57.000', '2024-07-28 11:16:57.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(104, 5,'2024-07-28 11:18:09.000', '2024-07-28 11:18:09.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(105, 3,'2024-07-28 11:18:28.000', '2024-07-28 11:18:28.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(106, 1,'2024-07-28 11:19:03.000', '2024-07-28 11:19:03.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(107, 1,'2024-07-28 11:19:19.000', '2024-07-28 11:19:19.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(108, 7,'2024-07-28 11:27:42.000', '2024-07-28 11:27:42.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(109, 7,'2024-07-28 11:27:43.000', '2024-07-28 11:27:43.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(110, 7,'2024-07-28 11:27:43.000', '2024-07-28 11:27:43.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(111, 5,'2024-07-30 22:57:44.000', '2024-07-30 22:57:44.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(112, 3,'2024-07-30 22:57:56.000', '2024-07-30 22:57:56.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(113, 7,'2024-07-30 23:04:11.000', '2024-07-30 23:04:11.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(114, 7,'2024-07-30 23:04:12.000', '2024-07-30 23:04:12.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(115, 7,'2024-07-30 23:04:12.000', '2024-07-30 23:04:12.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(116, 3,'2024-07-30 23:08:36.000', '2024-07-30 23:08:36.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(117, 5,'2024-07-30 23:09:29.000', '2024-07-30 23:09:29.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(118, 1,'2024-07-30 23:10:28.000', '2024-07-30 23:10:28.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(119, 3,'2024-07-30 23:22:16.000', '2024-07-30 23:22:16.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(120, 1,'2024-07-30 23:22:38.000', '2024-07-30 23:22:38.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(121, 1,'2024-07-30 23:27:34.000', '2024-07-30 23:27:34.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(122, 7,'2024-07-30 23:32:46.000', '2024-07-30 23:32:46.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(123, 7,'2024-07-30 23:32:46.000', '2024-07-30 23:32:46.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(124, 7,'2024-07-30 23:32:46.000', '2024-07-30 23:32:46.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(131, 5,'2024-08-24 22:02:59.000', '2024-08-24 22:02:59.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(132, 7,'2024-08-24 22:16:16.000', '2024-08-24 22:16:16.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(133, 7,'2024-08-24 22:16:16.000', '2024-08-24 22:16:16.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(134, 7,'2024-08-24 22:16:17.000', '2024-08-24 22:16:17.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(135, 3,'2024-09-09 22:24:46.000', '2024-09-09 22:24:46.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(136, 2,'2024-09-09 22:25:12.000', '2024-09-09 22:25:12.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(137, 1,'2024-09-09 22:25:42.000', '2024-09-09 22:25:42.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(138, 1,'2024-09-09 22:27:14.000', '2024-09-09 22:27:14.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(139, 1,'2024-09-09 22:27:31.000', '2024-09-09 22:27:31.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(140, 1,'2024-09-09 22:27:46.000', '2024-09-09 22:27:46.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(141, 5,'2024-09-09 22:28:52.000', '2024-09-09 22:28:52.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(142, 5,'2024-09-09 22:29:32.000', '2024-09-09 22:29:32.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(143, 1,'2024-09-09 22:30:29.000', '2024-09-09 22:30:29.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(144, 1,'2024-09-09 22:30:52.000', '2024-09-09 22:30:52.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(145, 5,'2024-09-09 22:34:03.000', '2024-09-09 22:34:03.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(146, 7,'2024-09-09 22:43:45.000', '2024-09-09 22:43:45.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(147, 7,'2024-09-09 22:43:45.000', '2024-09-09 22:43:45.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(148, 7,'2024-09-09 22:43:46.000', '2024-09-09 22:43:46.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(149, 3,'2024-09-15 22:09:28.000', '2024-09-15 22:09:28.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(150, 5,'2024-09-15 22:10:41.000', '2024-09-15 22:10:41.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(151, 7,'2024-09-15 22:17:01.000', '2024-09-15 22:17:01.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(152, 7,'2024-09-15 22:17:01.000', '2024-09-15 22:17:01.000');
INSERT INTO value (id, `typeValueId`, `createdAt`, `updatedAt`) VALUES(153, 7,'2024-09-15 22:17:01.000', '2024-09-15 22:17:01.000');
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
