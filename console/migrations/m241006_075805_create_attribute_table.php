<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%attribute}}`.
 */
class m241006_075805_create_attribute_table extends Migration
{
    private const TABLE_NAME = '{{%attribute}}';
    private const TABLE_COMMENT = 'Атрибуты';
    
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
            'unitId' => $this->integer(10)->unsigned()->comment('ИД единицы измерения'),
            'dictionaryId' => $this->integer(10)->unsigned()->comment('ИД словаря'),
            'typeValueId' => $this->integer(10)->unsigned()->notNull()->comment('ИД типа значения'),
            'name' => $this->string(128)->notNull()->comment('Наименование'),
            'description' => $this->string(128)->notNull()->comment('Описание атрибута'),
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
