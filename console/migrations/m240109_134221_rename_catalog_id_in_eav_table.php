<?php

use yii\db\Migration;

/**
 * Class m240109_134221_rename_catalog_id_in_eav_table
 */
class m240109_134221_rename_catalog_id_in_eav_table extends Migration
{
    protected const TABLE_NAME = '{{%eav}}';


    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn(self::TABLE_NAME, 'entityId', 'catalogEntityId');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn(self::TABLE_NAME, 'catalogEntityId', 'entityId');
    }

}
