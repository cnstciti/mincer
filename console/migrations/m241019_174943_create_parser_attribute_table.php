<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%parser_attribute}}`.
 */
class m241019_174943_create_parser_attribute_table extends Migration
{
    private const TABLE_NAME = '{{%parser_attribute}}';
    private const TABLE_COMMENT = 'Парсер - атрибуты';
    
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
            'name' => $this->string(255)->notNull()->comment('Наименование'),
            'attributeId' => $this->integer(10)->unsigned()->comment('ИД атрибута'),
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
