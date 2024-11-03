<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%parser_value_image}}`.
 */
class m241027_151825_create_parser_value_image_table extends Migration
{
    private const TABLE_NAME = '{{%parser_value_image}}';
    private const TABLE_COMMENT = 'Парсер - Значения-изображения';
    
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
            'dir' => $this->string(255)->notNull()->comment('Путь файла'),
            'fileName' => $this->string(255)->notNull()->comment('Наименование файла'),
            'extension' => $this->string(255)->notNull()->comment('Расширение файла'),
            'height' => $this->integer(10)->unsigned()->notNull()->comment('Высота изображения'),
            'width' => $this->integer(10)->unsigned()->notNull()->comment('Ширина изображения'),
            'size' => $this->integer(10)->unsigned()->notNull()->comment('Размер файла, КБ'),
            'status' => $this->string(128)->comment('Статус'),
            'createdAt' => $this->timestamp()->defaultExpression('NOW()')->comment('Дата создания'),
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
