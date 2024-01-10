<?php

use yii\db\Migration;

/**
 * Handles dropping columns from table `{{%entity}}`.
 */
class m240109_133637_drop_catalog_id_column_from_entity_table extends Migration
{
    protected const TABLE_NAME = '{{%entity}}';


    public function up()
    {
        $this->dropColumn(self::TABLE_NAME, 'catalogId');
    }

    public function down()
    {
        $this->addColumn(
            self::TABLE_NAME,
            'catalogId',
            $this->integer()->unsigned()->notNull()->comment('_ИД каталога_')
        );
    }

}
