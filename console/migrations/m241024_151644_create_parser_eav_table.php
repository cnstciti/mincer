<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%parser_eav}}`.
 */
class m241024_151644_create_parser_eav_table extends Migration
{
    private const TABLE_NAME = '{{%parser_eav}}';
    private const TABLE_COMMENT = 'Парсер - связь продуктов и атрибутов и значений';
    
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
            'entityAttributeId' => $this->integer(10)->unsigned()->notNull()->comment('ИД связи Продукт - Атрибут'),
            'valueId' => $this->integer(10)->unsigned()->notNull()->comment('ИД значения'),
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
