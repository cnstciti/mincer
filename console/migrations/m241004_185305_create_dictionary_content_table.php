<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%dictionary_content}}`.
 */
class m241004_185305_create_dictionary_content_table extends Migration
{
    private const TABLE_NAME = '{{%dictionary_content}}';
    private const TABLE_COMMENT = 'Содержание словарей';
    
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
            'dictionaryId' => $this->integer(10)->unsigned()->notNull()->comment('ИД словаря'),
            'value' => $this->string(128)->notNull()->unique()->comment('Значение словоря'),
            'createdAt' => $this->timestamp()->notNull()->comment('Дата создания'),
            'updatedAt' => $this->timestamp()->notNull()->comment('Дата изменения'),
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
