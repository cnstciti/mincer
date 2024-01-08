<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%value_float}}`.
 */
class m231218_202200_create_value_float_table extends Migration
{
    protected const TABLE_NAME = '{{%value_float}}';
    
    
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = '';
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT='Значения - число с плавающей запятой'";
        }
        
        $this->createTable(
            self::TABLE_NAME, [
            'id'        => $this->primaryKey()->unsigned()->comment('_ИД_'),
            'value'     => $this->decimal(10,3)->notNull()->comment('_Само значение_'),
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
