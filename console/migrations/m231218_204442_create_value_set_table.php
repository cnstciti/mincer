<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%value_set}}`.
 */
class m231218_204442_create_value_set_table extends Migration
{
    protected const TABLE_NAME = '{{%value_set}}';
    
    
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = '';
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT='Значения - множество'";
        }
        
        $this->createTable(
            self::TABLE_NAME, [
            'id'                  => $this->primaryKey()->unsigned()->comment('_ИД_'),
            'dictionaryContentId' => $this->integer()->unsigned()->notNull()->comment('_ИД содержания словаря_'),
            'createdAt'           => $this->timestamp()->notNull()->comment('_Дата создания_'),
            'updatedAt'           => $this->timestamp()->notNull()->comment('_Дата изменения_'),
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
