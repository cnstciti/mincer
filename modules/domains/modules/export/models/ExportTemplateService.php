<?php declare(strict_types = 1);

namespace modules\domains\modules\export\models;

use modules\domains\Module;
use modules\domains\modules\catalog\models\CatalogService;
use Yii;
use yii\helpers\Json;

class ExportTemplateService
{
    
    public static function getTemplate(int $catalogId): string
    {
        $data = [
            'catalog'    => self::getCatalog($catalogId),
            'entity'     => self::getEntity(),
            'attributes' => self::getAttributes($catalogId),
        ];
    
        $filePath = sprintf(
            '%s/template_%d_%s.json',
            Yii::getAlias('@export'),
            $catalogId,
            date('Ymd_his')
        );
    
        $fp = fopen($filePath, 'w+');
        fwrite($fp, Json::encode($data));
        fclose($fp);
        
        return $filePath;
    }
    
    private static function getCatalog(int $catalogId): array
    {
        return [
            'catalogId'   => $catalogId,
            'catalogName' => CatalogService::getName($catalogId),
        ];
    }
    
    private static function getEntity(): array
    {
        return [
            'entityId'   => null,
            'entityName' => '',
        ];
    }
    
    private static function getAttributes(int $catalogId): array
    {
        $attributes = [];
        foreach (self::getAttributesData($catalogId) as $a) {
            $attributes[] = [
                'attributeId'    => $a['id'],
                'attributeName'  => $a['name'],
                'unitId'         => $a['u_id'],
                'unitName'       => $a['u_name'],
                'dictionaryId'   => $a['d_id'],
                'dictionaryName' => $a['d_name'],
                'typeId'         => $a['t_id'],
                'typeName'       => $a['t_name'],
                'values'         => [
                    [
                        'valueId' => null,
                        'value'   => null,
                    ]
                ],
            ];
        }
        
        return $attributes;
    }
    
    private static function getAttributesData(int $catalogId): array
    {
        $query = '
            select a.*, u.id u_id, u.shortName u_name, d.id d_id, d.name d_name, t.id t_id, t.name t_name
            from attribute a
            left join catalog_attribute ca on ca.attributeId=a.id
            left join unit u on a.unitId=u.id
            left join dictionary d on a.dictionaryId=d.id
            left join type_value t on a.typeValueId=t.id
            where ca.catalogId = :catalogId
        ';
    
        $vars = [
            ':catalogId' => $catalogId,
        ];
    
        return Module::getInstance()
                     ->getDb()
                     ->createCommand($query, $vars)
                     ->queryAll();
    }

}
