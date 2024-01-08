<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%attribute}}`.
 */
class m231218_144327_create_attribute_table extends Migration
{
    protected const TABLE_NAME = '{{%attribute}}';
    
    
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = '';
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT='Атрибуты'";
        }
        
        $this->createTable(
            self::TABLE_NAME, [
            'id'           => $this->primaryKey()->unsigned()->comment('_ИД_'),
            'unitId'       => $this->integer()->unsigned()->null()->comment('_ИД единицы измерения_'),
            'dictionaryId' => $this->integer()->unsigned()->null()->comment('_ИД словаря_'),
            'typeValueId'  => $this->integer()->unsigned()->notNull()->comment('_ИД типа значения_'),
            'name'         => $this->string(255)->notNull()->comment('_Наименование_'),
            'description'  => $this->string(255)->notNull()->comment('_Описание атрибута_'),
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
