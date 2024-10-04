<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%type_value}}`.
 */
class m241003_154435_create_type_value_table extends Migration
{
    private const TABLE_NAME = '{{%type_value}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT='Типы значений'";
        }
        
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey()->comment('ИД'),
            'name' => $this->string(128)->notNull()->unique()->comment('Наименование'),
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
