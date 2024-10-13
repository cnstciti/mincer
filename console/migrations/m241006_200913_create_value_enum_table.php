<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%value_enum}}`.
 */
class m241006_200913_create_value_enum_table extends Migration
{
    private const TABLE_NAME = '{{%value_enum}}';
    private const TABLE_COMMENT = 'Значения - перечисляемый тип';
    
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
            'id' => $this->integer(10)->notNull()->unsigned()->comment('ИД'),
            'dictionaryContentId' => $this->integer(10)->unsigned()->notNull()->comment('ИД содержания словаря'),
            'createdAt' => $this->timestamp()->notNull()->comment('Дата создания'),
            'updatedAt' => $this->timestamp()->notNull()->comment('Дата изменения'),
        ], $tableOptions);
    
        $this->addPrimaryKey('value_enum_pk', self::TABLE_NAME, ['id']);
    }
    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
