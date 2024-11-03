<?php

use yii\db\Migration;

/**
 * Class m241024_164801_create_v_parser_value_view
 */
class m241024_164801_create_v_parser_value_view extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        /** @lang MySQL */
        $query = <<<QUERY
CREATE OR REPLACE VIEW `v_parser_value_view`
AS select
	`c`.`id` as `catalogId`,
    `c`.`name` as `catalogName`,
    `pe`.`id` as `parserEntityId`,
    `pe`.`name` as `parserEntityName`,
    `pe`.`isBaseEntity` as `isBaseEntity`,
    `e`.`id` as `entityId`,
    `e`.`name` as `entityName`,
    `pa`.`id` as `parserAttributeId`,
    `pa`.`name` as `parserAttributeName`,
    `a`.`id` as `attributeId`,
    `a`.`name` as `attributeName`,
    `tv`.`id` as `typeId`,
    `tv`.`name` as `typeName`,
    `u`.`id` as `unitId`,
    `u`.`shortName` as `unitName`,
    `d`.`id` as `dictionaryId`,
    `d`.`name` as `dictionaryName`,
    `pv`.`id` as `valueId`,
    `pv`.`meaning` as `meaning`,
    `dc`.`id` as `dictionaryContentId`,
    `dc`.`value` as `dictionaryContentValue`,
    `pv`.`dictionaryContentId` as `parserDictionaryContentId`
from parser_entity pe
left join catalog c on c.id = pe.catalogId
left join entity e on e.id = pe.entityId
left join parser_entity_attribute pea on pe.id = pea.parserEntityId
left join parser_attribute pa on pa.id = pea.parserAttributeId
left join attribute a on a.id = pa.attributeId
left join type_value tv on tv.id = a.typeValueId
left join unit u on u.id = a.unitId
left join dictionary d on d.id = a.dictionaryId
left join parser_eav eav on pea.id = eav.entityAttributeId
left join parser_value pv on pv.id = eav.valueId
left join dictionary_content dc on dc.id = pv.dictionaryContentId
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
DROP view `v_parser_value_view`
QUERY;
        $this->execute($query);
    }
}
