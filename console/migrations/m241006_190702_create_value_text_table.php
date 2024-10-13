<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%value_text}}`.
 */
class m241006_190702_create_value_text_table extends Migration
{
    private const TABLE_NAME = '{{%value_text}}';
    private const TABLE_COMMENT = 'Значения - текст';
    
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
            'value' => $this->text()->notNull()->comment('Суть значения'),
            'createdAt' => $this->timestamp()->notNull()->comment('Дата создания'),
            'updatedAt' => $this->timestamp()->notNull()->comment('Дата изменения'),
        ], $tableOptions);
    
        $this->addPrimaryKey('value_text_pk', self::TABLE_NAME, ['id']);
    }
    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }

}
