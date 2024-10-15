<?php

use yii\db\Migration;

/**
 * Class m241006_204813_create_v_img_type_data_view
 */
class m241006_204813_create_v_img_type_data_view extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        /** @lang MySQL */
        $query = <<<QUERY
create or replace
view  `v_img_type_data` as
select
    `c`.`id` as `catalogId`,
    `c`.`name` as `catalogName`,
    `e`.`id` as `entityId`,
    `e`.`name` as `entityName`,
    `a`.`id` as `attributeId`,
    `a`.`name` as `attributeName`,
    `tv`.`id` as `typeId`,
    `tv`.`name` as `typeName`,
     `eav`.`id` as `eavId`,
    `uv`.`id` as `valueId`,
    `uv`.`file` as `file`,
    `uv`.`height` as `height`,
    `uv`.`width` as `width`,
    `uv`.`size` as `size`,
    `uv`.`type` as `type`,
    `uv`.`numGroup` as `numGroup`,
    `ca`.`id` as `catalogAttributeId`,
    `ce`.`id` as `catalogEntityId`
from
    (((((((( `attribute` `a`
left join  `catalog_attribute` `ca` on
    ((`a`.`id` = `ca`.`attributeId`)))
left join  `catalog` `c` on
    ((`c`.`id` = `ca`.`catalogId`)))
left join  `catalog_entity` `ce` on
    ((`c`.`id` = `ce`.`catalogId`)))
left join  `entity` `e` on
    ((`e`.`id` = `ce`.`entityId`)))
left join  `type_value` `tv` on
    ((`tv`.`id` = `a`.`typeValueId`)))
left join  `eav` on
    (((`ce`.`id` =  `eav`.`catalogEntityId`)
    and (`ca`.`id` =  `eav`.`catalogAttributeId`))))
left join  `value` `v` on
    ((`v`.`id` =  `eav`.`valueId`)))
left join (
    select
        `vi`.`id` as `id`,
        `vi`.`file` as `file`,
        `vi`.`height` as `height`,
        `vi`.`width` as `width`,
        `vi`.`size` as `size`,
        `vi`.`type` as `type`,
        `vi`.`numGroup` as `numGroup`,
        `vi`.`createdAt` as `createdAt`,
        `vi`.`updatedAt` as `updatedAt`
    from
         `value_image` `vi`) `uv` on
    ((`v`.`id` = `uv`.`id`)))
where
    (`tv`.`name` = 'img')
QUERY;
        $this->execute($query);
    }
    
    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        /** @lang MySQL */
        $query = <<<QUERY
DROP view `v_img_type_data`
QUERY;
        $this->execute($query);
    }
}
