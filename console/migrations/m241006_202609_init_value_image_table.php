<?php

use yii\db\Migration;

/**
 * Class m241006_202609_init_value_image_table
 */
class m241006_202609_init_value_image_table extends Migration
{
    private const TABLE_NAME = '{{%value_image}}';
    
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        /** @lang MySQL */
        $query = <<<QUERY
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(21, 'ul/8e/63/xn/i57sa40z.webp', 480, 480, 19146, 'catalog', 1, '2024-06-30 12:08:20.000', '2024-06-30 12:08:20.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(22, 'tx/mf/w0/7b/g05veuya.webp', 500, 500, 22746, 'card', 1, '2024-06-30 12:08:20.000', '2024-06-30 12:08:20.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(23, '83/tl/69/5z/av5jnwcl.webp', 480, 480, 21354, 'wm', 1, '2024-06-30 12:08:20.000', '2024-06-30 12:08:20.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(24, 'bn/67/01/hv/51rkace0.webp', 321, 480, 8530, 'catalog', 2, '2024-06-30 12:08:59.000', '2024-06-30 12:08:59.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(25, '06/h7/wm/4b/89wtf6x2.webp', 647, 970, 24882, 'card', 2, '2024-06-30 12:08:59.000', '2024-06-30 12:08:59.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(26, 'kp/5r/vy/74/jp0m5cos.webp', 321, 480, 10268, 'wm', 2, '2024-06-30 12:08:59.000', '2024-06-30 12:08:59.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(30, '3r/y9/dk/iv/e0v4ai85.webp', 480, 480, 14098, 'catalog', 1, '2024-07-02 17:08:57.000', '2024-07-02 17:08:57.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(31, 'x6/m4/wg/hu/nya2ie0c.webp', 500, 500, 16402, 'card', 1, '2024-07-02 17:08:57.000', '2024-07-02 17:08:57.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(32, '3o/47/ku/gh/brjkcxeg.webp', 480, 480, 16922, 'wm', 1, '2024-07-02 17:08:58.000', '2024-07-02 17:08:58.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(33, 'du/te/a4/5r/gh1m2qd3.webp', 321, 480, 8960, 'catalog', 2, '2024-07-02 17:09:11.000', '2024-07-02 17:09:11.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(34, 'n5/p9/aq/z7/qra9fo17.webp', 647, 970, 30520, 'card', 2, '2024-07-02 17:09:12.000', '2024-07-02 17:09:12.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(35, 'bv/it/md/q4/jq4otirz.webp', 321, 480, 10690, 'wm', 2, '2024-07-02 17:09:12.000', '2024-07-02 17:09:12.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(41, 'kr/ch/82/43/x0mcnt8e.webp', 480, 480, 13270, 'catalog', 1, '2024-07-02 19:27:35.000', '2024-07-02 19:27:35.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(42, 'mo/rj/l8/6h/5ost3v87.webp', 500, 500, 15836, 'card', 1, '2024-07-02 19:27:35.000', '2024-07-02 19:27:35.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(43, 's4/hu/al/kq/dm347har.webp', 480, 480, 15748, 'wm', 1, '2024-07-02 19:27:36.000', '2024-07-02 19:27:36.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(44, 'h2/0v/y7/zs/ub74jv1f.webp', 374, 480, 19316, 'catalog', 2, '2024-07-02 19:27:47.000', '2024-07-02 19:27:47.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(45, 'kj/7s/5u/v6/t237fyiz.webp', 933, 1200, 64450, 'card', 2, '2024-07-02 19:27:48.000', '2024-07-02 19:27:48.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(46, 'oj/ey/v0/6f/udw165fv.webp', 374, 480, 19894, 'wm', 2, '2024-07-02 19:27:49.000', '2024-07-02 19:27:49.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(50, 'pu/i6/rh/s7/vsajzey3.webp', 321, 480, 8872, 'catalog', 2, '2024-07-02 19:29:31.000', '2024-07-02 19:29:31.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(51, 'z5/4f/86/qm/l8bcq6an.webp', 647, 970, 30518, 'card', 2, '2024-07-02 19:29:31.000', '2024-07-02 19:29:31.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(52, '82/x5/mv/6p/5xgqmd1k.webp', 321, 480, 10528, 'wm', 2, '2024-07-02 19:29:31.000', '2024-07-02 19:29:31.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(55, 'z3/ok/fl/8g/foakrnz0.webp', 444, 480, 22752, 'catalog', 1, '2024-07-22 16:17:46.000', '2024-07-22 16:17:46.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(56, 'dw/m5/qx/9p/tiua9hy0.webp', 662, 716, 39888, 'card', 1, '2024-07-22 16:17:46.000', '2024-07-22 16:17:46.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(57, 'z3/ae/ij/4x/4fwozq7p.webp', 444, 480, 24710, 'wm', 1, '2024-07-22 16:17:46.000', '2024-07-22 16:17:46.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(58, 'g9/4v/kz/hw/eavb7qt9.webp', 422, 480, 24294, 'catalog', 2, '2024-07-22 16:18:02.000', '2024-07-22 16:18:02.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(59, 'y1/id/ro/bv/dc9r48mh.webp', 814, 926, 60410, 'card', 2, '2024-07-22 16:18:02.000', '2024-07-22 16:18:02.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(60, 'bp/ih/3r/8f/cy873qie.webp', 422, 480, 25634, 'wm', 2, '2024-07-22 16:18:02.000', '2024-07-22 16:18:02.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(61, 'ij/09/81/lg/52d6qltz.webp', 321, 480, 8774, 'catalog', 2, '2024-07-22 16:18:16.000', '2024-07-22 16:18:16.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(62, 'wz/rd/lu/fh/mq3cugys.webp', 647, 970, 27614, 'card', 2, '2024-07-22 16:18:17.000', '2024-07-22 16:18:17.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(63, 'dl/en/aj/xk/20m13fip.webp', 321, 480, 10506, 'wm', 2, '2024-07-22 16:18:17.000', '2024-07-22 16:18:17.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(71, '29/ck/bs/7p/krcdx8un.webp', 362, 480, 11764, 'catalog', 1, '2024-07-22 17:22:23.000', '2024-07-22 17:22:23.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(72, '2x/ws/lp/6d/k5l3cu94.webp', 630, 836, 23198, 'card', 1, '2024-07-22 17:22:24.000', '2024-07-22 17:22:24.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(73, 'kb/qm/57/18/bq5npdji.webp', 362, 480, 13174, 'wm', 1, '2024-07-22 17:22:24.000', '2024-07-22 17:22:24.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(74, '1a/qz/pr/kj/nadf69y3.webp', 321, 480, 9668, 'catalog', 2, '2024-07-22 17:22:45.000', '2024-07-22 17:22:45.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(75, '23/sq/4n/vr/n9licmbu.webp', 647, 970, 30930, 'card', 2, '2024-07-22 17:22:45.000', '2024-07-22 17:22:45.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(76, 'l9/4n/mx/so/31ibnwx5.webp', 321, 480, 11294, 'wm', 2, '2024-07-22 17:22:46.000', '2024-07-22 17:22:46.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(82, '08/g4/7m/jr/1t75macq.webp', 321, 480, 9658, 'catalog', 1, '2024-07-22 22:57:03.000', '2024-07-22 22:57:03.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(83, 'ow/3z/ls/c4/yksfl4dg.webp', 647, 970, 33328, 'card', 1, '2024-07-22 22:57:03.000', '2024-07-22 22:57:03.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(84, 'jw/nh/37/09/3m18h0ac.webp', 321, 480, 11316, 'wm', 1, '2024-07-22 22:57:04.000', '2024-07-22 22:57:04.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(91, 'f8/t7/h0/z3/5zp087u1.webp', 480, 480, 17848, 'catalog', 1, '2024-07-22 23:29:09.000', '2024-07-22 23:29:09.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(92, 'do/y1/nw/5k/nzwxb62y.webp', 500, 500, 21508, 'card', 1, '2024-07-22 23:29:09.000', '2024-07-22 23:29:09.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(93, '0q/4i/sz/nx/k5lhe1pi.webp', 480, 480, 20590, 'wm', 1, '2024-07-22 23:29:09.000', '2024-07-22 23:29:09.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(96, 'd8/r6/qp/4e/2bgqeroa.webp', 480, 480, 12580, 'catalog', 1, '2024-07-23 08:26:21.000', '2024-07-23 08:26:21.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(97, '3v/y1/k5/9d/eri6gf85.webp', 500, 500, 14324, 'card', 1, '2024-07-23 08:26:22.000', '2024-07-23 08:26:22.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(98, 'nx/p3/2a/87/eqpgibts.webp', 480, 480, 15394, 'wm', 1, '2024-07-23 08:26:22.000', '2024-07-23 08:26:22.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(99, 'q6/ur/wg/79/2qvm6upi.webp', 321, 480, 11144, 'catalog', 2, '2024-07-23 08:26:36.000', '2024-07-23 08:26:36.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(100, 'k6/df/w0/13/m9qy1xus.webp', 647, 970, 37284, 'card', 2, '2024-07-23 08:26:36.000', '2024-07-23 08:26:36.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(101, 'a3/68/ju/7c/s0rd9i7k.webp', 321, 480, 12514, 'wm', 2, '2024-07-23 08:26:36.000', '2024-07-23 08:26:36.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(108, 'tr/pa/wk/9o/g8tcqvn4.webp', 382, 480, 19116, 'catalog', 1, '2024-07-28 11:27:42.000', '2024-07-28 11:27:42.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(109, 'yl/kf/ap/1d/yez4v2l6.webp', 453, 570, 25764, 'card', 1, '2024-07-28 11:27:43.000', '2024-07-28 11:27:43.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(110, 'vx/sp/g7/3e/xy95ze08.webp', 382, 480, 20828, 'wm', 1, '2024-07-28 11:27:43.000', '2024-07-28 11:27:43.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(113, '5t/j3/e4/w7/ovh2pefi.webp', 321, 480, 11002, 'catalog', 1, '2024-07-30 23:04:11.000', '2024-07-30 23:04:11.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(114, 'vq/z3/lc/re/y63pz1xs.webp', 647, 970, 36906, 'card', 1, '2024-07-30 23:04:12.000', '2024-07-30 23:04:12.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(115, 'lg/wr/mq/04/qsvm0wl9.webp', 321, 480, 12336, 'wm', 1, '2024-07-30 23:04:12.000', '2024-07-30 23:04:12.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(122, '3a/db/4h/cv/4v6zc9hl.webp', 321, 480, 11208, 'catalog', 1, '2024-07-30 23:32:46.000', '2024-07-30 23:32:46.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(123, '4q/8i/gl/an/ptue86yl.webp', 647, 970, 39944, 'card', 1, '2024-07-30 23:32:46.000', '2024-07-30 23:32:46.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(124, 'a9/cg/0h/j2/w102yq9k.webp', 321, 480, 12498, 'wm', 1, '2024-07-30 23:32:46.000', '2024-07-30 23:32:46.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(132, 'lx/z4/7v/6n/nabd5u4q.webp', 321, 480, 11050, 'catalog', 1, '2024-08-24 22:16:16.000', '2024-08-24 22:16:16.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(133, 'za/dx/j8/lf/hcmaorw7.webp', 647, 970, 39338, 'card', 1, '2024-08-24 22:16:17.000', '2024-08-24 22:16:17.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(134, '7f/8o/jc/dy/csfm69i4.webp', 321, 480, 12416, 'wm', 1, '2024-08-24 22:16:17.000', '2024-08-24 22:16:17.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(146, '6x/7v/pc/yf/diw54bry.webp', 320, 480, 10310, 'catalog', 1, '2024-09-09 22:43:45.000', '2024-09-09 22:43:45.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(147, '2y/5k/gu/j6/mk57rqb4.webp', 646, 970, 34432, 'card', 1, '2024-09-09 22:43:45.000', '2024-09-09 22:43:45.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(148, 'n6/ou/ql/9z/068enaqf.webp', 320, 480, 11516, 'wm', 1, '2024-09-09 22:43:46.000', '2024-09-09 22:43:46.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(151, 'ms/ky/xg/v8/ot0vq6lx.webp', 320, 480, 10314, 'catalog', 1, '2024-09-15 22:17:01.000', '2024-09-15 22:17:01.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(152, 'bt/95/6h/f4/8qo2nw9d.webp', 646, 970, 30678, 'card', 1, '2024-09-15 22:17:01.000', '2024-09-15 22:17:01.000');
INSERT INTO value_image (id, file, height, width, `size`, `type`, `numGroup`, `createdAt`, `updatedAt`) VALUES(153, 'n1/st/ei/c3/60wctmfz.webp', 320, 480, 11508, 'wm', 1, '2024-09-15 22:17:01.000', '2024-09-15 22:17:01.000');
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
