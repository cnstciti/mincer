<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%catalog}}`.
 */
class m241005_072050_create_catalog_table extends Migration
{
    private const TABLE_NAME = '{{%catalog}}';
    private const TABLE_COMMENT = 'Каталоги';
    
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
            'parentId' => $this->integer(10)->unsigned()->notNull()->comment('ИД родителя'),
            'name' => $this->string(128)->notNull()->unique()->comment('Наименование'),
            'containsProducts' => $this->integer(1)->unsigned()->notNull()->defaultValue(0)->comment('Содержит товары или каталог верхнего уровня'),
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
