<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%parser_entity}}`.
 */
class m241016_151152_create_parser_entity_table extends Migration
{
    private const TABLE_NAME = '{{%parser_entity}}';
    private const TABLE_COMMENT = 'Парсер - сущности';
    
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
            'catalogId' => $this->integer(10)->unsigned()->comment('ИД каталога'),
            'entityId' => $this->integer(10)->unsigned()->comment('ИД продукта'),
            'parserSiteId' => $this->integer(10)->unsigned()->comment('ИД сайта-донора'),
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
