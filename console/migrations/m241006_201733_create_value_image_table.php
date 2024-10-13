<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%value_image}}`.
 */
class m241006_201733_create_value_image_table extends Migration
{
    private const TABLE_NAME = '{{%value_image}}';
    private const TABLE_COMMENT = 'Значения - изображения';
    
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT='" . self::TABLE_COMMENT . "'";
        }
        
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey()->unsigned()->comment('ИД'),
            'file' => $this->string(255)->notNull()->comment('Наименование файла, где хранится изображение'),
            'height' => $this->integer(10)->unsigned()->notNull()->comment('Высота изображения'),
            'width' => $this->integer(10)->unsigned()->notNull()->comment('Ширина изображения'),
            'size' => $this->integer(10)->unsigned()->notNull()->comment('Размер файла, КБ'),
            'type' => "enum('catalog','wm','card') comment 'Тип изображения'",
            'numGroup' => $this->integer(10)->unsigned()->notNull()->comment('Группировка одного изображения'),
            'createdAt' => $this->timestamp()->notNull()->comment('Дата создания'),
            'updatedAt' => $this->timestamp()->notNull()->comment('Дата изменения'),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
