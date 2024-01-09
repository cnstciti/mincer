<?php declare(strict_types = 1);

namespace modules\domains\modules\value\models;

use Exception;
use modules\domains\Module as BaseModule;
use modules\domains\modules\attribute\models\AttributeTable;
use modules\domains\modules\value\models\values\TypeValue;
use Throwable;
use yii\data\ActiveDataProvider;

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
            $this->getDataProvider((int)$queryParams['catalogId']),
            $title,
            (int)$queryParams['catalogId'],
            (int)$queryParams['entityId'],
            $this->getValueAttributes((int)$queryParams['entityId'])
        );
    }
    
    /**
     * сохранение
     *
     * @param int $typeValueId
     * @param int $isDelete
     */
    public static function insert(int $valueId, int $typeValueId, int $isDelete = 0): void
    {
        // TODO переделать через DI
        $t              = new ValueTable();
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
     * возвращает провайдер атрибутов каталога
     *
     * @param int $catalogId
     *
     * @return ActiveDataProvider
     */
    public function getDataProvider(int $catalogId): ActiveDataProvider
    {
        $query = AttributeTable::find()
                               ->from('attribute a')
                               ->leftJoin('catalog_attribute ca', 'ca.attributeId=a.id')
                               ->where(['ca.catalogId' => $catalogId]);
        
        return new ActiveDataProvider([
            'query'      => $query,
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);
    }
    
    public static function getValueAttributes(int $entityId): array
    {
        $query = sprintf("
                select
                    v.*, ca.attributeId, ca.id as ca_id,
                    CASE
                        WHEN tv.name='%s'
                            THEN (select vi.value from value_int vi where vi.id=v.id)
                        WHEN tv.name='%s'
                            THEN (select vf.value from value_float vf where vf.id=v.id)
                        WHEN tv.name='%s'
                            THEN (select vs.value from value_string vs where vs.id=v.id)
                        WHEN tv.name='%s'
                            THEN (select vt.value from value_text vt where vt.id=v.id)
                        WHEN tv.name='%s'
                            THEN (select dc.value
                                    from dictionary_content dc
                                    left join value_set vs on vs.dictionaryContentId=dc.id
                                          where vs.id=v.id)
                        WHEN tv.name='%s'
                            THEN (select dc.value
                                    from dictionary_content dc
                                    left join value_set vs on vs.dictionaryContentId=dc.id
                                          where vs.id=v.id)
                    END as value
                from value v
                left join eav on eav.valueId=v.id
                left join catalog_attribute ca on eav.catalogAttributeId=ca.id
                left join type_value tv on v.typeValueId=tv.id
                where eav.entityId=:entityId
            ",
            TypeValue::INT,
            TypeValue::FLOAT,
            TypeValue::STRING,
            TypeValue::TEXT,
            TypeValue::ENUM,
            TypeValue::SET
        );
    /*
            SELECT * FROM (
                SELECT e.id AS entityId,
                       e.name AS entityName,
                       a.name AS attributeName,
                       f.value AS attributeValue,
                       u.nameRuShort AS unit,
                       ca.numSort AS sort
                  FROM value_float f
                  JOIN entity e ON f.idEntity=e.id
                  JOIN attribute a ON f.idAttribute=a.id
                  LEFT JOIN unit u ON a.idUnit=u.id
                  JOIN category_attribute ca ON ca.idAttribute=a.id
                 WHERE e.id = :idEntity and ca.idCategory=e.idCategory
            UNION ALL
                SELECT e.id AS entityId,
                       e.name AS entityName,
                       a.name AS attributeName,
                       i.value AS attributeValue,
                       u.rusName1 AS unit,
                       ca.numSort AS sort
                  FROM value_int i
                  JOIN entity e ON i.idEntity=e.id
                  JOIN attribute a ON i.idAttribute=a.id
                  LEFT JOIN unit u ON a.idUnit=u.id
                  JOIN category_attribute ca ON ca.idAttribute=a.id
                 WHERE e.id = :idEntity and ca.idCategory=e.idCategory
            UNION ALL
                SELECT e.id AS entityId,
                       e.name AS entityName,
                       a.name AS attributeName,
                       t.value AS attributeValue,
                       u.rusName1 AS unit,
                       ca.numSort AS sort
                  FROM value_text t
                  JOIN entity e ON t.idEntity=e.id
                  JOIN attribute a ON t.idAttribute=a.id
                  LEFT JOIN unit u ON a.idUnit=u.id
                  JOIN category_attribute ca ON ca.idAttribute=a.id
                 WHERE e.id = :idEntity and ca.idCategory=e.idCategory
            UNION ALL
                SELECT e.id AS entityId,
                       e.name AS entityName,
                       a.name AS attributeName,
                       s.value AS attributeValue,
                       u.rusName1 AS unit,
                       ca.numSort AS sort
                  FROM value_string s
                  JOIN entity e ON s.idEntity=e.id
                  JOIN attribute a ON s.idAttribute=a.id
                  LEFT JOIN unit u ON a.idUnit=u.id
                  JOIN category_attribute ca ON ca.idAttribute=a.id
                 WHERE e.id = :idEntity and ca.idCategory=e.idCategory
            UNION ALL
                SELECT e.id AS entityId,
                       e.name AS entityName,
                       a.name AS attributeName,
                       GROUP_CONCAT(ov.value SEPARATOR ' / ') AS attributeValue,
                       u.rusName1 AS unit,
                       ca.numSort AS sort
                  FROM value_set s
                  JOIN entity e ON s.idEntity=e.id
                  JOIN attribute a ON s.idAttribute=a.id
                  JOIN option_value ov ON s.idOptionValue=ov.id
                  LEFT JOIN unit u ON a.idUnit=u.id
                  JOIN category_attribute ca ON ca.idAttribute=a.id
                 WHERE e.id = :idEntity and ca.idCategory=e.idCategory
                 GROUP BY entityId, entityName, attributeName, unit, sort
                ) product
            ORDER BY sort
    git remote add origin https://github.com/cnstciti/mincer.git
select GROUP_CONCAT(dc.value SEPARATOR ' / ') AS value
                                    from dictionary_content dc
                                    left join value_set vs on vs.dictionaryContentId=dc.id
                                          where vs.id=v.id
     */
        $vars = [
            ':entityId' => $entityId,
        ];
        
        return BaseModule::getInstance()
                         ->getDb()
                         ->createCommand($query, $vars)
                         ->queryAll();
    }
    
}
