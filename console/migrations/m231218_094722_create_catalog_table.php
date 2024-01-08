<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%catalog}}`.
 */
class m231218_094722_create_catalog_table extends Migration
{
    protected const TABLE_NAME = '{{%catalog}}';
    
    
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = '';
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT='Каталоги'";
        }
        
        $this->createTable(
            self::TABLE_NAME, [
            'id'           => $this->primaryKey()->unsigned()->comment('_ИД_'),
            'parentId'     => $this->integer()->unsigned()->notNull()->comment('_ИД родителя_'),
            'name'         => $this->string(128)->notNull()->comment('_Наименование_'),
            'prefixEntity' => $this->string(128)->null()->comment('_Префикс сущности_'),
            'formatEntity' => $this->string(128)->null()->comment('_Формат полного имени сущности_'),
            'isEndItem'    => $this->tinyInteger(1)->unsigned()->notNull()->comment('_Признак листа дерева_'),
            'isDelete'     => $this->tinyInteger(1)->unsigned()->notNull()->comment('_Признак удаления_'),
            'createdAt'    => $this->timestamp()->notNull()->comment('_Дата создания_'),
            'updatedAt'    => $this->timestamp()->notNull()->comment('_Дата изменения_'),
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
