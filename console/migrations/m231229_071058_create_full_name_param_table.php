<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%full_name_param}}`.
 */
class m231229_071058_create_full_name_param_table extends Migration
{
    protected const TABLE_NAME = '{{%full_name_param}}';
    
    
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = '';
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT='Данные для формирования полного имени продукта'";
        }
        
        $this->createTable(
            self::TABLE_NAME, [
            'id'             => $this->primaryKey()->unsigned()->comment('_ИД_'),
            'sequenceNumber' => $this->integer()->unsigned()->notNull()->comment('_Номер в последовательности атрибутов_'),
            'createdAt'      => $this->timestamp()->notNull()->comment('_Дата создания_'),
            'updatedAt'      => $this->timestamp()->notNull()->comment('_Дата изменения_'),
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
