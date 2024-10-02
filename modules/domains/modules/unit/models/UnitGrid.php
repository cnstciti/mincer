<?php declare(strict_types = 1);

namespace modules\domains\modules\unit\models;

use kartik\bs5dropdown\ButtonDropdown;
use modules\domains\BaseGrid;
use Throwable;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;

class UnitGrid extends BaseGrid
{
    
    /**
     * Возвращает грид
     *
     * @param UnitSearch         $searchModel
     * @param ActiveDataProvider $dataProvider
     * @param string             $title
     * @param bool               $isEdit
     *
     * @return string
     * @throws Throwable
     */
    public static function get(
        UnitSearch $searchModel,
        ActiveDataProvider $dataProvider,
        string $title,
        bool $isEdit
    ): string
    {
        self::$panelHeading   = $title;
        self::$toolbarContent = $isEdit
            ? Html::a(
                'Создать единицу измерения',
                ['create'],
                ['class' => 'btn btn-outline-success']
            )
            : '';
        
        return self::widget([
            'dataProvider' => $dataProvider,
            'filterModel'  => $searchModel,
            'columns'      => self::columns($isEdit),
        ]);
    }
    
    /**
     * Возвращает колонки грида
     *
     * @return array
     */
    private static function columns(bool $isEdit): array
    {
        return [
            [
                'attribute' => 'id',
                'width'     => '80px',
                'vAlign'    => 'middle',
            ],
            [
                'attribute' => 'shortName',
                'vAlign'    => 'middle',
            ],
            [
                'attribute' => 'name',
                'vAlign'    => 'middle',
            ],
            /*[
                'attribute' => 'isDelete',
                'width'     => '80px',
                'vAlign'    => 'middle',
            ],*/
            [
                'format' => 'raw',
                'value'  => function ($row) use ($isEdit) {
                    $items = $isEdit
                        ? [
                            [
                                'label' => 'Редактировать',
                                'url'   => Url::to(['update', 'unitId' => $row->id]),
                            ],
                        ]
                        : [];
                    
                    return ButtonDropdown::widget([
                        'label'         => 'Действия',
                        'dropdown'      => [
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
