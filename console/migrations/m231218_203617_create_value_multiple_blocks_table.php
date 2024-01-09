<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%value_multiple_blocks}}`.
 */
class m231218_203617_create_value_multiple_blocks_table extends Migration
{
    protected const TABLE_NAME = '{{%value_multiple_blocks}}';
    
    
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = '';
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT='Значения - блоки текста'";
        }
        
        $this->createTable(
            self::TABLE_NAME, [
            'id'        => $this->primaryKey()->unsigned()->comment('_ИД_'),
            'title'     => $this->string(255)->notNull()->comment('_Наименование блока_'),
            'content'   => $this->text()->notNull()->comment('_Содержание блока_'),
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
