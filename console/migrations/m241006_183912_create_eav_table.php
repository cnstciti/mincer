<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%eav}}`.
 */
class m241006_183912_create_eav_table extends Migration
{
    private const TABLE_NAME = '{{%eav}}';
    private const TABLE_COMMENT = 'Связь Сущность-Атрибут-Значение';
    
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
            'catalogEntityId' => $this->integer(10)->unsigned()->notNull()->comment('ИД Каталог-Продукт'),
            'catalogAttributeId' => $this->integer(10)->unsigned()->notNull()->comment('ИД Каталог-Атрибут'),
            'valueId' => $this->integer(10)->unsigned()->notNull()->comment('ИД значения'),
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
