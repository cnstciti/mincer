<?php

use yii\db\Migration;

/**
 * Class m241101_184533_create_v_parser_img_view
 */
class m241101_184533_create_v_parser_img_view extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        /** @lang MySQL */
        $query = <<<QUERY
create or replace
view `v_parser_img_view` as
select
    `pe`.`id` as `parserEntityId`,
    `pe`.`name` as `parserEntityName`,
    `pe`.`isBaseEntity` as `isBaseEntity`,
    `pe`.`entityId` as `entityId`,
    `pvi`.`id` as `imgId`,
    `pvi`.`dir` as `dir`,
    `pvi`.`extension` as `extension`,
    `pvi`.`fileName` as `fileName`,
    `pvi`.`height` as `height`,
    `pvi`.`width` as `width`,
    `pvi`.`size` as `size`,
    `pvi`.`status` as `imgStatus`,
    `tv`.`id` as `typeId`
from
    ((((((`parser_entity` `pe`
left join `parser_entity_attribute` `pea` on
    ((`pe`.`id` = `pea`.`parserEntityId`)))
left join `parser_attribute` `pa` on
    ((`pa`.`id` = `pea`.`parserAttributeId`)))
left join `attribute` `a` on
    ((`a`.`id` = `pa`.`attributeId`)))
left join `type_value` `tv` on
    ((`tv`.`id` = `a`.`typeValueId`)))
left join `parser_eav` `eav` on
    ((`pea`.`id` = `eav`.`entityAttributeId`)))
left join `parser_value_image` `pvi` on
    ((`pvi`.`id` = `eav`.`valueId`)))
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
DROP view `v_parser_img_view`
QUERY;
        $this->execute($query);
    }
}
