<?php declare(strict_types = 1);

namespace modules\domains\modules\value\models;

use Exception;
use modules\domains\Module as BaseModule;
use modules\domains\modules\attribute\models\AttributeTable;
use modules\domains\modules\value\models\values\TypeValue;
use Throwable;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;

class ValueService
{
    private const TITLE = 'Значения';
    
    
    /**
     * Заголовок
     *
     * @return string
     */
    public static function getTitle(): string
    {
        return self::TITLE;
    }
    
    /**
     * Грид
     *
     * @param array  $queryParams
     * @param string $title
     *
     * @return string
     * @throws Throwable
     */
    public function getGrid(
        array $queryParams,
        string $title
    ): string {
        return ValueGrid::get(
            $this->getDataProvider((int)$queryParams['catalogId'], (int)$queryParams['entityId']),
            $title,
            (int)$queryParams['catalogId'],
            (int)$queryParams['entityId'],
            $this->getValueAttributes((int)$queryParams['catalogId'], (int)$queryParams['entityId'])
        );
    }
    
    /**
     * сохранение
     *
     * @param ValueTable $t
     * @param int $valueId
     * @param int $typeValueId
     * @param int $isDelete
     * @return void
     */
    public static function insert(
        ValueTable $t,
        int $valueId,
        int $typeValueId,
        int $isDelete = 0
    ): void
    {
        $t->id          = $valueId;
        $t->typeValueId = $typeValueId;
        $t->isDelete    = $isDelete;
        $t->save();
    }
    
    /**
     * Последний (максимальный) ИД
     *
     * @return int
     */
    public static function lastId(): int
    {
        return ValueTable::lastId();
    }
    
    /**
     * очистка
     *
     * @throws \yii\db\Exception
     * @throws Exception
     */
    public static function truncate()
    {
        BaseModule::getInstance()
              ->getDb()
              ->createCommand()
              ->truncateTable(ValueTable::tableName())
              ->execute();
    }
    
    /**
     * Возвращает провайдер атрибутов каталога
     *
     * @param int $catalogId
     *
     * @return SqlDataProvider
     */
    public function getDataProvider(int $catalogId, int $entityId): SqlDataProvider
    {
        $query = "
            SELECT  a.id as attributeId,
                    vi.id as valueId,
                    vi.value AS value,
                    a.name as attributeName,
                    tv.name as typeName,
                    u.shortName as unitName,
                    '' as dictionaryName,
                    v.isDelete AS isDelete
            FROM value_int vi
                    LEFT JOIN value v ON v.id=vi.id
                    LEFT JOIN eav on eav.valueId=v.id
                    LEFT JOIN catalog_attribute ca on ca.id=eav.catalogAttributeId
                    LEFT JOIN catalog_entity ce on ce.id=eav.catalogEntityId
                    LEFT JOIN type_value tv on v.typeValueId=tv.id
                    LEFT JOIN attribute a ON ca.attributeId=a.id
                    LEFT JOIN unit u ON a.unitId=u.id
            WHERE ce.catalogId=:catalogId and ce.entityId=:entityId
            UNION ALL
            SELECT  a.id as attributeId,
                    vf.id as valueId,
                    vf.value AS value,
                    a.name as attributeName,
                    tv.name as typeName,
                    u.shortName as unitName,
                    '' as dictionaryName,
                    v.isDelete AS isDelete
            FROM value_float vf
                     LEFT JOIN value v ON v.id=vf.id
                     LEFT JOIN eav on eav.valueId=v.id
                     LEFT JOIN catalog_attribute ca on ca.id=eav.catalogAttributeId
                     LEFT JOIN catalog_entity ce on ce.id=eav.catalogEntityId
                     LEFT JOIN type_value tv on v.typeValueId=tv.id
                     LEFT JOIN attribute a ON ca.attributeId=a.id
                     LEFT JOIN unit u ON a.unitId=u.id
            WHERE ce.catalogId=:catalogId and ce.entityId=:entityId
            UNION ALL
            SELECT  a.id as attributeId,
                    vs.id as valueId,
                    vs.value AS value,
                    a.name as attributeName,
                    tv.name as typeName,
                    u.shortName as unitName,
                    '' as dictionaryName,
                    v.isDelete AS isDelete
            FROM value_string vs
                     LEFT JOIN value v ON v.id=vs.id
                     LEFT JOIN eav on eav.valueId=v.id
                     LEFT JOIN catalog_attribute ca on ca.id=eav.catalogAttributeId
                     LEFT JOIN catalog_entity ce on ce.id=eav.catalogEntityId
                     LEFT JOIN type_value tv on v.typeValueId=tv.id
                     LEFT JOIN attribute a ON ca.attributeId=a.id
                     LEFT JOIN unit u ON a.unitId=u.id
            WHERE ce.catalogId=:catalogId and ce.entityId=:entityId
            UNION ALL
            SELECT  a.id as attributeId,
                    vt.id as valueId,
                    vt.value AS value,
                    a.name as attributeName,
                    tv.name as typeName,
                    u.shortName as unitName,
                    '' as dictionaryName,
                    v.isDelete AS isDelete
            FROM value_text vt
                     LEFT JOIN value v ON v.id=vt.id
                     LEFT JOIN eav on eav.valueId=v.id
                     LEFT JOIN catalog_attribute ca on ca.id=eav.catalogAttributeId
                     LEFT JOIN catalog_entity ce on ce.id=eav.catalogEntityId
                     LEFT JOIN type_value tv on v.typeValueId=tv.id
                     LEFT JOIN attribute a ON ca.attributeId=a.id
                     LEFT JOIN unit u ON a.unitId=u.id
            WHERE ce.catalogId=:catalogId and ce.entityId=:entityId
            UNION ALL
            SELECT  a.id as attributeId,
                    GROUP_CONCAT(vs.id SEPARATOR ' / ') AS valueId,
                    GROUP_CONCAT(dc.value SEPARATOR ' / ') AS value,
                    a.name as attributeName,
                    tv.name as typeName,
                    u.shortName as unitName,
                    d.name as dictionaryName,
                    GROUP_CONCAT(v.isDelete SEPARATOR ' / ') AS isDelete
            FROM value_set vs
                    LEFT JOIN value v ON v.id=vs.id
                    LEFT JOIN eav on eav.valueId=v.id
                    LEFT JOIN catalog_attribute ca on ca.id=eav.catalogAttributeId
                    LEFT JOIN catalog_entity ce on ce.id=eav.catalogEntityId
                    LEFT JOIN type_value tv on v.typeValueId=tv.id
                    LEFT JOIN dictionary_content dc ON vs.dictionaryContentId=dc.id
                    LEFT JOIN attribute a ON ca.attributeId=a.id
                    LEFT JOIN unit u ON a.unitId=u.id
                    LEFT JOIN dictionary d ON a.dictionaryId=d.id
            WHERE ce.catalogId=:catalogId and ce.entityId=:entityId
            GROUP BY ca.attributeId
        ";
        /*
                $query = "
                    SELECT  a.id as attributeId,
                            vi.id as valueId,
                            vi.value AS value,
                            a.name as attributeName,
                            tv.name as typeName,
                            u.shortName as unitName,
                            d.name as dictionaryName,
                            v.isDelete AS isDelete
                    FROM value_int vi
                            LEFT JOIN value v ON v.id=vi.id
                            LEFT JOIN eav on eav.valueId=v.id
                            LEFT JOIN catalog_attribute ca on ca.id=eav.catalogAttributeId
                            LEFT JOIN catalog_entity ce on ce.id=eav.catalogEntityId
                            LEFT JOIN type_value tv on v.typeValueId=tv.id
                            LEFT JOIN attribute a ON ca.attributeId=a.id
                            LEFT JOIN unit u ON a.unitId=u.id
                            LEFT JOIN dictionary d ON a.dictionaryId=d.id
                    WHERE ce.catalogId=:catalogId and ce.entityId=:entityId
                    UNION ALL
                    SELECT  a.id as attributeId,
                            vf.id as valueId,
                            vf.value AS value,
                            a.name as attributeName,
                            tv.name as typeName,
                            u.shortName as unitName,
                            d.name as dictionaryName,
                            v.isDelete AS isDelete
                    FROM value_float vf
                             LEFT JOIN value v ON v.id=vf.id
                             LEFT JOIN eav on eav.valueId=v.id
                             LEFT JOIN catalog_attribute ca on ca.id=eav.catalogAttributeId
                             LEFT JOIN catalog_entity ce on ce.id=eav.catalogEntityId
                             LEFT JOIN type_value tv on v.typeValueId=tv.id
                             LEFT JOIN attribute a ON ca.attributeId=a.id
                             LEFT JOIN unit u ON a.unitId=u.id
                             LEFT JOIN dictionary d ON a.dictionaryId=d.id
                    WHERE ce.catalogId=:catalogId and ce.entityId=:entityId
                    UNION ALL
                    SELECT  a.id as attributeId,
                            vs.id as valueId,
                            vs.value AS value,
                            a.name as attributeName,
                            tv.name as typeName,
                            u.shortName as unitName,
                            d.name as dictionaryName,
                            v.isDelete AS isDelete
                    FROM value_string vs
                             LEFT JOIN value v ON v.id=vs.id
                             LEFT JOIN eav on eav.valueId=v.id
                             LEFT JOIN catalog_attribute ca on ca.id=eav.catalogAttributeId
                             LEFT JOIN catalog_entity ce on ce.id=eav.catalogEntityId
                             LEFT JOIN type_value tv on v.typeValueId=tv.id
                             LEFT JOIN attribute a ON ca.attributeId=a.id
                             LEFT JOIN unit u ON a.unitId=u.id
                             LEFT JOIN dictionary d ON a.dictionaryId=d.id
                    WHERE ce.catalogId=:catalogId and ce.entityId=:entityId
                    UNION ALL
                    SELECT  a.id as attributeId,
                            vt.id as valueId,
                            vt.value AS value,
                            a.name as attributeName,
                            tv.name as typeName,
                            u.shortName as unitName,
                            d.name as dictionaryName,
                            v.isDelete AS isDelete
                    FROM value_text vt
                             LEFT JOIN value v ON v.id=vt.id
                             LEFT JOIN eav on eav.valueId=v.id
                             LEFT JOIN catalog_attribute ca on ca.id=eav.catalogAttributeId
                             LEFT JOIN catalog_entity ce on ce.id=eav.catalogEntityId
                             LEFT JOIN type_value tv on v.typeValueId=tv.id
                             LEFT JOIN attribute a ON ca.attributeId=a.id
                             LEFT JOIN unit u ON a.unitId=u.id
                             LEFT JOIN dictionary d ON a.dictionaryId=d.id
                    WHERE ce.catalogId=:catalogId and ce.entityId=:entityId
                    UNION ALL
                    SELECT  a.id as attributeId,
                            GROUP_CONCAT(vs.id SEPARATOR ' / ') AS valueId,
                            GROUP_CONCAT(dc.value SEPARATOR ' / ') AS value,
                            a.name as attributeName,
                            tv.name as typeName,
                            u.shortName as unitName,
                            d.name as dictionaryName,
                            GROUP_CONCAT(v.isDelete SEPARATOR ' / ') AS isDelete
                    FROM value_set vs
                            LEFT JOIN value v ON v.id=vs.id
                            LEFT JOIN eav on eav.valueId=v.id
                            LEFT JOIN catalog_attribute ca on ca.id=eav.catalogAttributeId
                            LEFT JOIN catalog_entity ce on ce.id=eav.catalogEntityId
                            LEFT JOIN type_value tv on v.typeValueId=tv.id
                            LEFT JOIN dictionary_content dc ON vs.dictionaryContentId=dc.id
                            LEFT JOIN attribute a ON ca.attributeId=a.id
                            LEFT JOIN unit u ON a.unitId=u.id
                            LEFT JOIN dictionary d ON a.dictionaryId=d.id
                    WHERE ce.catalogId=:catalogId and ce.entityId=:entityId
                    GROUP BY ca.attributeId
                ";
        */
        $count = BaseModule::getInstance()
            ->getDb()
            ->createCommand('SELECT COUNT(*) FROM (' . $query . ') d', [
                ':catalogId' => $catalogId,
                ':entityId' => $entityId,
            ])
            ->queryScalar();

        return new SqlDataProvider([
            'sql' => 'SELECT* FROM (' . $query . ') d order by attributeName',
            'params' => [
                ':catalogId' => $catalogId,
                ':entityId' => $entityId,
            ],
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);
    }
    
    public static function getValueAttributes(int $catalogId, int $entityId): array
    {
        $query = "
            SELECT  a.id as attributeId,
                    vi.id as valueId,
                    vi.value AS value,
                    a.name as attributeName,
                    tv.name as typeName,
                    u.shortName as unitName,
                    d.name as dictionaryName,
                    v.isDelete AS isDelete
            FROM value_int vi
                    LEFT JOIN value v ON v.id=vi.id
                    LEFT JOIN eav on eav.valueId=v.id
                    LEFT JOIN catalog_attribute ca on ca.id=eav.catalogAttributeId
                    LEFT JOIN catalog_entity ce on ce.id=eav.catalogEntityId
                    LEFT JOIN type_value tv on v.typeValueId=tv.id
                    LEFT JOIN attribute a ON ca.attributeId=a.id
                    LEFT JOIN unit u ON a.unitId=u.id
                    LEFT JOIN dictionary d ON a.dictionaryId=d.id
            WHERE ce.catalogId=:catalogId and ce.entityId=:entityId
            UNION ALL
            SELECT  a.id as attributeId,
                    vf.id as valueId,
                    vf.value AS value,
                    a.name as attributeName,
                    tv.name as typeName,
                    u.shortName as unitName,
                    d.name as dictionaryName,
                    v.isDelete AS isDelete
            FROM value_float vf
                     LEFT JOIN value v ON v.id=vf.id
                     LEFT JOIN eav on eav.valueId=v.id
                     LEFT JOIN catalog_attribute ca on ca.id=eav.catalogAttributeId
                     LEFT JOIN catalog_entity ce on ce.id=eav.catalogEntityId
                     LEFT JOIN type_value tv on v.typeValueId=tv.id
                     LEFT JOIN attribute a ON ca.attributeId=a.id
                     LEFT JOIN unit u ON a.unitId=u.id
                     LEFT JOIN dictionary d ON a.dictionaryId=d.id
            WHERE ce.catalogId=:catalogId and ce.entityId=:entityId
            UNION ALL
            SELECT  a.id as attributeId,
                    vs.id as valueId,
                    vs.value AS value,
                    a.name as attributeName,
                    tv.name as typeName,
                    u.shortName as unitName,
                    d.name as dictionaryName,
                    v.isDelete AS isDelete
            FROM value_string vs
                     LEFT JOIN value v ON v.id=vs.id
                     LEFT JOIN eav on eav.valueId=v.id
                     LEFT JOIN catalog_attribute ca on ca.id=eav.catalogAttributeId
                     LEFT JOIN catalog_entity ce on ce.id=eav.catalogEntityId
                     LEFT JOIN type_value tv on v.typeValueId=tv.id
                     LEFT JOIN attribute a ON ca.attributeId=a.id
                     LEFT JOIN unit u ON a.unitId=u.id
                     LEFT JOIN dictionary d ON a.dictionaryId=d.id
            WHERE ce.catalogId=:catalogId and ce.entityId=:entityId
            UNION ALL
            SELECT  a.id as attributeId,
                    vt.id as valueId,
                    vt.value AS value,
                    a.name as attributeName,
                    tv.name as typeName,
                    u.shortName as unitName,
                    d.name as dictionaryName,
                    v.isDelete AS isDelete
            FROM value_text vt
                     LEFT JOIN value v ON v.id=vt.id
                     LEFT JOIN eav on eav.valueId=v.id
                     LEFT JOIN catalog_attribute ca on ca.id=eav.catalogAttributeId
                     LEFT JOIN catalog_entity ce on ce.id=eav.catalogEntityId
                     LEFT JOIN type_value tv on v.typeValueId=tv.id
                     LEFT JOIN attribute a ON ca.attributeId=a.id
                     LEFT JOIN unit u ON a.unitId=u.id
                     LEFT JOIN dictionary d ON a.dictionaryId=d.id
            WHERE ce.catalogId=:catalogId and ce.entityId=:entityId
            UNION ALL
            SELECT  a.id as attributeId,
                    GROUP_CONCAT(vs.id SEPARATOR ' / ') AS valueId,
                    GROUP_CONCAT(dc.value SEPARATOR ' / ') AS value,
                    a.name as attributeName,
                    tv.name as typeName,
                    u.shortName as unitName,
                    d.name as dictionaryName,
                    GROUP_CONCAT(v.isDelete SEPARATOR ' / ') AS isDelete
            FROM value_set vs
                    LEFT JOIN value v ON v.id=vs.id
                    LEFT JOIN eav on eav.valueId=v.id
                    LEFT JOIN catalog_attribute ca on ca.id=eav.catalogAttributeId
                    LEFT JOIN catalog_entity ce on ce.id=eav.catalogEntityId
                    LEFT JOIN type_value tv on v.typeValueId=tv.id
                    LEFT JOIN dictionary_content dc ON vs.dictionaryContentId=dc.id
                    LEFT JOIN attribute a ON ca.attributeId=a.id
                    LEFT JOIN unit u ON a.unitId=u.id
                    LEFT JOIN dictionary d ON a.dictionaryId=d.id
            WHERE ce.catalogId=:catalogId and ce.entityId=:entityId
            GROUP BY ca.attributeId
        ";

        $vars = [
            ':catalogId' => $catalogId,
            ':entityId' => $entityId,
        ];
        
        return BaseModule::getInstance()
                         ->getDb()
                         ->createCommand($query, $vars)
                         ->queryAll();
    }
    
}
