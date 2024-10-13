<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%value_string}}`.
 */
class m241006_190401_create_value_string_table extends Migration
{
    private const TABLE_NAME = '{{%value_string}}';
    private const TABLE_COMMENT = 'Значения - строка';
    
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
            'id' => $this->integer(10)->notNull()->unsigned()->comment('ИД'),
            'value' => $this->string(255)->notNull()->comment('Суть значения'),
            'createdAt' => $this->timestamp()->notNull()->comment('Дата создания'),
            'updatedAt' => $this->timestamp()->notNull()->comment('Дата изменения'),
        ], $tableOptions);
    
        $this->addPrimaryKey('value_string_pk', self::TABLE_NAME, ['id']);
    }
    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
