<?php declare(strict_types = 1);

namespace modules\domains\modules\simple_type\models;

use kartik\bs5dropdown\ButtonDropdown;
use modules\domains\BaseGrid;
use Throwable;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;

class SimpleTypeGrid extends BaseGrid
{
    
    /**
     * Возвращает грид
     *
     * @param SimpleTypeSearch   $searchModel
     * @param ActiveDataProvider $dataProvider
     * @param string             $title
     * @param int                $entityId
     * @param int                $catalogId
     * @return string
     * @throws Throwable
     */
    public static function get(
        SimpleTypeSearch $searchModel,
        ActiveDataProvider $dataProvider,
        string $title,
        int $entityId,
        int $catalogId
    ): string
    {
        self::$panelHeading = $title;
        self::$toolbarContent = Html::a(
            'Скопировать все значения',
            ['simple-type-select-all', 'entityId' => $entityId, 'catalogId' => $catalogId],
            ['class' => 'btn btn-outline-success']
        );
        
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
            [
                'label'       => "Единица<br>измерения",
                'encodeLabel' => false,
                'attribute'   => 'unitName',
                'vAlign'      => 'middle',
            ],
            [
                'label'     => 'Словарь',
                'attribute' => 'dictionaryName',
                'vAlign'    => 'middle',
            ],
            [
                'label'       => 'Атрибут',
                'attribute'   => 'attributeName',
                'vAlign'      => 'middle',
            ],
            [
                'label'     => "Значение",
                //'attribute' => 'value',
                'vAlign'    => 'middle',
                'value'  => function ($row) {
                    if ($row->value && $row->typeName == 'text') {
                        return substr($row->value, 0, 30);
                    }
    
                    return $row->value;
                },
            ],
            [
                 'label'  => '',
                 'format' => 'raw',
                 'value'  => function ($row) {
                     $items = [
                         [
                             'label' => 'Редактировать',
                             'url'   => Url::to([
                                 'simple-type-update',
                                 'typeName'           => $row['typeName'],
                                 'attributeName'      => $row['attributeName'],
                                 'catalogId'          => $row['catalogId'] ?? 0,
                                 'entityId'           => $row['entityId'] ?? 0,
                                 'valueId'            => $row['valueId'] ?? 0,
                                 'dictionaryId'       => $row['dictionaryId'] ?? 0,
                                 'catalogAttributeId' => $row['catalogAttributeId'],
                                 'catalogEntityId'    => $row['catalogEntityId'],
                                 'typeId'             => $row['typeId'],
                             ]),
                         ],
                         [
                             'label' => 'Скопировать значение',
                             'url'   => Url::to([
                                 'simple-type-select',
                                 'catalogId'     => $row['catalogId'] ?? 0,
                                 'entityId'      => $row['entityId'] ?? 0,
                                 'attributeName' => $row['attributeName'],
                                 'attributeId'   => $row['attributeId'],
                             ]),
                         ],
                     ];
    
                     return ButtonDropdown::widget([
                         'label'    => 'Действия',
                         'dropdown' => [
                             'items' => $items,
                         ],
                         'buttonOptions' => ['class' => 'btn-outline-primary'],
                     ]);
                 },
                 'width'  => '80px',
                 'vAlign' => 'middle',
             ],
        ];
    }
    
}
