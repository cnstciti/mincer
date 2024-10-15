<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%value_float}}`.
 */
class m241006_185855_create_value_float_table extends Migration
{
    private const TABLE_NAME = '{{%value_float}}';
    private const TABLE_COMMENT = 'Значения - число с плавающей запятой';
    
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
            'value' => $this->decimal(10, 3)->notNull()->comment('Суть значения'),
            'createdAt' => $this->timestamp()->notNull()->comment('Дата создания'),
            'updatedAt' => $this->timestamp()->notNull()->comment('Дата изменения'),
        ], $tableOptions);
    
    
        $this->addPrimaryKey('value_float_pk', self::TABLE_NAME, ['id']);
    }
    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
