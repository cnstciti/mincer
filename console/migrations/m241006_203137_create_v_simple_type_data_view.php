<?php

use yii\db\Migration;

/**
 * Class m241006_203137_create_v_simple_type_data_view
 */
class m241006_203137_create_v_simple_type_data_view extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        /** @lang MySQL */
        $query = <<<QUERY
create or replace
view `v_simple_type_data` as
select
    `c`.`id` as `catalogId`,
    `c`.`name` as `catalogName`,
    `e`.`id` as `entityId`,
    `e`.`name` as `entityName`,
    `a`.`id` as `attributeId`,
    `a`.`name` as `attributeName`,
    `tv`.`id` as `typeId`,
    `tv`.`name` as `typeName`,
    `u`.`id` as `unitId`,
    `u`.`shortName` as `unitName`,
    `d`.`id` as `dictionaryId`,
    `d`.`name` as `dictionaryName`,
     `eav`.`id` as `eavId`,
    `uv`.`id` as `valueId`,
    `uv`.`value` as `value`,
    `ca`.`id` as `catalogAttributeId`,
    `ce`.`id` as `catalogEntityId`
from
    (((((((((( `attribute` `a`
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
left join  `unit` `u` on
    ((`u`.`id` = `a`.`unitId`)))
left join  `dictionary` `d` on
    ((`d`.`id` = `a`.`dictionaryId`)))
left join  `eav` on
    (((`ce`.`id` =  `eav`.`catalogEntityId`)
    and (`ca`.`id` =  `eav`.`catalogAttributeId`))))
left join  `value` `v` on
    ((`v`.`id` =  `eav`.`valueId`)))
left join (
    select
        `vi`.`id` as `id`,
        `vi`.`value` as `value`
    from
         `value_int` `vi`
union all
    select
        `vf`.`id` as `id`,
        `vf`.`value` as `value`
    from
         `value_float` `vf`
union all
    select
        `vs`.`id` as `id`,
        `vs`.`value` as `value`
    from
         `value_string` `vs`
union all
    select
        `vt`.`id` as `id`,
        `vt`.`value` as `value`
    from
         `value_text` `vt`
union all
    select
        `ve`.`id` as `id`,
        `dc`.`value` as `value`
    from
        ( `value_enum` `ve`
    left join  `dictionary_content` `dc` on
        ((`ve`.`dictionaryContentId` = `dc`.`id`)))) `uv` on
    ((`v`.`id` = `uv`.`id`)))
where
    (`tv`.`name` in ('int',
    'float',
    'string',
    'text',
    'enum'))
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
DROP view `v_simple_type_data`
QUERY;
        $this->execute($query);
    }
}
