<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%type_value}}`.
 */
class m231218_201355_create_type_value_table extends Migration
{
    protected const TABLE_NAME = '{{%type_value}}';
    
    
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = '';
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT='Типы значений'";
        }
        
        $this->createTable(
            self::TABLE_NAME, [
            'id'        => $this->primaryKey()->unsigned()->comment('_ИД_'),
            'name'      => $this->string(128)->notNull()->unique()->comment('_Наименование_'),
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
