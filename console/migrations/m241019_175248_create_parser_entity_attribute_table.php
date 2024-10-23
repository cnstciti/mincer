<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%parser_entity_attribute}}`.
 */
class m241019_175248_create_parser_entity_attribute_table extends Migration
{
    private const TABLE_NAME = '{{%parser_entity_attribute}}';
    private const TABLE_COMMENT = 'Парсер - связь продуктов и атрибутов';
    
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
            'parserEntityId' => $this->integer(10)->unsigned()->notNull()->comment('ИД продукта'),
            'parserAttributeId' => $this->integer(10)->unsigned()->notNull()->comment('ИД атрибута'),
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
