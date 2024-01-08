<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%entity}}`.
 */
class m231218_115334_create_entity_table extends Migration
{
    protected const TABLE_NAME = '{{%entity}}';
    
    
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = '';
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT='Сущности'";
        }
        
        $this->createTable(
            self::TABLE_NAME, [
            'id'        => $this->primaryKey()->unsigned()->comment('_ИД_'),
            'catalogId' => $this->integer()->unsigned()->notNull()->comment('_ИД каталога_'),
            'name'      => $this->string(128)->notNull()->unique()->comment('_Наименование_'),
            'fullName'  => $this->string(255)->null()->unique()->comment('_Полное наименование_'),
            'isDelete'  => $this->tinyInteger(1)->unsigned()->notNull()->comment('_Признак удаления_'),
            'createdAt' => $this->timestamp()->notNull()->comment('_Дата создания_'),
            'updatedAt' => $this->timestamp()->notNull()->comment('_Дата изменения_'),
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
