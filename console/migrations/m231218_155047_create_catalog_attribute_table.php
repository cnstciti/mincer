<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%catalog_attribute}}`.
 */
class m231218_155047_create_catalog_attribute_table extends Migration
{
    protected const TABLE_NAME = '{{%catalog_attribute}}';
    
    
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = '';
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT='Связь каталогов и атрибутов'";
        }
        
        $this->createTable(
            self::TABLE_NAME, [
            'id'          => $this->primaryKey()->unsigned()->comment('_ИД_'),
            'catalogId'   => $this->integer()->unsigned()->notNull()->comment('_ИД каталога_'),
            'attributeId' => $this->integer()->unsigned()->notNull()->comment('_ИД атрибута_'),
            'createdAt'   => $this->timestamp()->notNull()->comment('_Дата создания_'),
            'updatedAt'   => $this->timestamp()->notNull()->comment('_Дата изменения_'),
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
