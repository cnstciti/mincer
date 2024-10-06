<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%catalog_entity}}`.
 */
class m241006_162048_create_catalog_entity_table extends Migration
{
    private const TABLE_NAME = '{{%catalog_entity}}';
    private const TABLE_COMMENT = 'Связь каталогов и продуктов';
    
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
            'catalogId' => $this->integer(10)->unsigned()->notNull()->comment('ИД каталога'),
            'entityId' => $this->integer(10)->unsigned()->notNull()->comment('ИД продукта'),
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
