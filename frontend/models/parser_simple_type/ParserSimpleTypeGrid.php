<?php declare(strict_types = 1);

namespace frontend\models\parser_simple_type;

use kartik\bs5dropdown\ButtonDropdown;
use modules\domains\BaseGrid;
use Throwable;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;

class ParserSimpleTypeGrid extends BaseGrid
{
    
    /**
     * Возвращает грид
     *
     * @param ParserSimpleTypeSearch   $searchModel
     * @param ActiveDataProvider $dataProvider
     * @param string             $title
     * @param int                $entityId
     * @param int                $catalogId
     * @return string
     * @throws Throwable
     */
    public static function get(
        ParserSimpleTypeSearch $searchModel,
        ActiveDataProvider $dataProvider,
        string $title
        /*,
        int $entityId,
        int $catalogId*/
    ): string
    {
        self::$panelHeading = $title;
        
        return self::widget([
            'dataProvider' => $dataProvider,
            'filterModel'  => $searchModel,
            'columns'      => self::columns(),
        ]);
    }
    
    /**
     * Возвращает колонки грида
     *
     * @return array
     */
    private static function columns(): array
    {
        return [
            [
                'label'       => "Тип",
                'attribute'   => 'typeName',
                'vAlign'      => 'middle',
            ],
           /* [
                'label'       => "Единица<br>измерения",
                'encodeLabel' => false,
                'attribute'   => 'unitName',
                'vAlign'      => 'middle',
            ],
           */
            [
                'label'       => 'Атрибут',
                'attribute'   => 'attributeName',
                'vAlign'      => 'middle',
            ],
            [
                'label'     => 'Словарь',
                'attribute' => 'dictionaryName',
                'vAlign'    => 'middle',
            ],
            [
                'label'     => "Содержание словаря",
                'vAlign'    => 'middle',
                'value'  => function ($row) {
                    if ($row->dictionaryContentValue) {
                        return $row->dictionaryContentValue;
                    }
        
                    if ($row->typeName == 'enum') {
                        return '===';
                    }
        
                    return '';
                },
            ],
            [
                'label'     => "Значение",
                'vAlign'    => 'middle',
                'value'  => function ($row) {
                    if ($row->meaning /*&& $row->typeName == 'text'*/) {
                        return substr($row->meaning, 0, 30);
                    }
    
                    return $row->meaning;
                },
            ],
            [
                 'label'  => '',
                 'format' => 'raw',
                 'value'  => function ($row) {
                     if ($row->typeName == 'enum') {
                         $items = [
                             [
                                 'label' => 'Привязать',
                                 'url'   => Url::to([
                                     'link-enum',
                                     /*'typeName'           => $row['typeName'],
                                     'attributeName'      => $row['attributeName'],
                                     'catalogId'          => $row['catalogId'] ?? 0,
                                     'entityId'           => $row['entityId'] ?? 0,
                                     'valueId'            => $row['valueId'] ?? 0,*/
                                     'parserEntityId' => $row['parserEntityId'] ?? 0,
                                     'dictionaryId' => $row['dictionaryId'] ?? 0,
                                     /*'catalogAttributeId' => $row['catalogAttributeId'],
                                     'catalogEntityId'    => $row['catalogEntityId'],
                                     'typeId'             => $row['typeId'],*/
                                 ]),
                             ],
                         ];
    
                         return ButtonDropdown::widget([
                             'label'         => 'Действия',
                             'dropdown'      => [
                                 'items' => $items,
                             ],
                             'buttonOptions' => ['class' => 'btn-outline-primary'],
                         ]);
                     }
                     
                     return '';
                 },
                 'width'  => '80px',
                 'vAlign' => 'middle',
             ],
        ];
    }
    
}
