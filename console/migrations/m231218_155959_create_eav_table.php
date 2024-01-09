<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%eav}}`.
 */
class m231218_155959_create_eav_table extends Migration
{
    protected const TABLE_NAME = '{{%eav}}';
    
    
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = '';
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT='Связь Сущность-Атрибут-Значение'";
        }
        
        $this->createTable(
            self::TABLE_NAME, [
            'id'                 => $this->primaryKey()->unsigned()->comment('_ИД_'),
            'entityId'           => $this->integer()->unsigned()->notNull()->comment('_ИД сущности_'),
            'catalogAttributeId' => $this->integer()->unsigned()->notNull()->comment('_ИД каталог-атрибут_'),
            'valueId'            => $this->integer()->unsigned()->notNull()->comment('_ИД значения_'),
            'createdAt'          => $this->timestamp()->notNull()->comment('_Дата создания_'),
            'updatedAt'          => $this->timestamp()->notNull()->comment('_Дата изменения_'),
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
