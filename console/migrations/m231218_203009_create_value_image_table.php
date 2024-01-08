<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%value_image}}`.
 */
class m231218_203009_create_value_image_table extends Migration
{
    protected const TABLE_NAME = '{{%value_image}}';
    
    
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = '';
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT='Значения - изображения'";
        }
        
        $this->createTable(
            self::TABLE_NAME, [
            'id'        => $this->primaryKey()->unsigned()->comment('_ИД_'),
            'file'      => $this->string(255)->notNull()->comment('_Наименование файла, где хранится изображение_'),
            'height'    => $this->integer()->unsigned()->notNull()->comment('_Высота изображения_'),
            'width'     => $this->integer()->unsigned()->notNull()->comment('_Ширина изображения_'),
            'size'      => $this->integer()->unsigned()->notNull()->comment('_Размер файла, КБ_'),
            'ext'       => $this->string(16)->notNull()->comment('_Расширение файла_'),
            'isDelete'  => $this->tinyInteger(1)->unsigned()->notNull()->comment('_Признак удаления_'),
            'createdAt' => $this->timestamp()->notNull()->comment('_Дата создания_'),
            'updatedAt' => $this->timestamp()->notNull()->comment('_Дата изменения_'),
        ],
            $tableOptions
        );
    }
    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
