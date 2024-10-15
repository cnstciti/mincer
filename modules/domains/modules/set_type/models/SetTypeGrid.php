<?php declare(strict_types = 1);

namespace modules\domains\modules\set_type\models;

use kartik\bs5dropdown\ButtonDropdown;
use modules\domains\BaseGrid;
use Throwable;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

class SetTypeGrid extends BaseGrid
{
    
    /**
     * Возвращает грид
     *
     * @param SetTypeSearch      $searchModel
     * @param ActiveDataProvider $dataProvider
     * @param string             $title
     * @return string
     * @throws Throwable
     */
    public static function get(
        SetTypeSearch $searchModel,
        ActiveDataProvider $dataProvider,
        string $title
    ): string
    {
        self::$panelHeading = $title;
        self::$toolbarContent = '';
        
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
                'label'       => 'Атрибут',
                'attribute'   => 'attributeName',
                'group' => true,
                'vAlign'      => 'middle',
            ],
            [
                'label'       => "Тип",
                'attribute'   => 'typeName',
                'group' => true,
                'vAlign'      => 'middle',
                //'subGroupOf' => 2,
            ],
            [
                'label'       => "Единица<br>измерения",
                'encodeLabel' => false,
                'value' => function ($model) {
                    return $model->unitName??'---';
                },
                'attribute'   => 'unitName',
                'group' => true,
                'vAlign'      => 'middle',
            ],
            [
                'label'     => 'Словарь',
                'value' => function ($model) {
                    return $model->dictionaryName??'---';
                },
                'attribute' => 'dictionaryName',
                'group' => true,
                'vAlign'    => 'middle',
            ],
            [
                'label'     => "Значение",
                'value' => function ($model) {
                    return $model->value??'---';
                },
                'attribute' => 'value',
                'vAlign'    => 'middle',
            ],
            [
                 'label'  => '',
                 'format' => 'raw',
                 'value'  => function ($row) {
                     $items = [
                         [
                             'label' => 'Редактировать',
                             'url'   => Url::to([
                                 'set-type-update',
                                 'attributeName'      => $row['attributeName'],
                                 'entityId'           => $row['entityId'],
                                 'catalogId'          => $row['catalogId'],
                                 'dictionaryId'       => $row['dictionaryId'],
                                 'catalogAttributeId' => $row['catalogAttributeId'],
                                 'catalogEntityId'    => $row['catalogEntityId'],
                                 'typeId'             => $row['typeId'],
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
