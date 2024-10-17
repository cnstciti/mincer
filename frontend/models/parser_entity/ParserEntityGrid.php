<?php declare(strict_types = 1);

namespace frontend\models\parser_entity;

use kartik\bs5dropdown\ButtonDropdown;
use modules\domains\BaseGrid;
use Throwable;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;

class ParserEntityGrid extends BaseGrid
{
    
    /**
     * Возвращает грид
     *
     * @param ParserEntitySearch $searchModel
     * @param ActiveDataProvider $dataProvider
     * @param string             $title
     * @param int                $catalogId
     *
     * @return string
     * @throws Throwable
     */
    public static function get(
        ParserEntitySearch $searchModel,
        ActiveDataProvider $dataProvider,
        string $title/*,
        int $catalogId*/
    ): string
    {
        self::$panelHeading   = $title;
        self::$toolbarContent = Html::a(
            'Создать продукт',
            ['create'/*, 'catalogId' => $catalogId*/],
            ['class' => 'btn btn-outline-success']
        );
        
        return self::widget([
            'dataProvider' => $dataProvider,
            'filterModel'  => $searchModel,
            'columns'      => self::columns(/*$catalogId*/),
        ]);
    }
    
    /**
     * Возвращает колонки грида
     *
     * @return array
     */
    private static function columns(/*int $catalogId*/): array
    {
        return [
            [
                'attribute' => 'id',
                'width'     => '80px',
                'vAlign'    => 'middle',
            ],
            [
                'attribute' => 'name',
                'vAlign'    => 'middle',
            ],
            [
                'label'  => 'Каталог',
                'format' => 'raw',
                'value'  => function ($row) {
                    if ($row->catalog) {
                        return sprintf(
                            '%s (ИД: %s)',
                            $row->catalog->name,
                            $row->catalog->id
                        );
                    }
            
                    return '---';
                },
                'vAlign' => 'middle',
            ],
            [
                'label'  => 'Сайт-донор',
                'format' => 'raw',
                'value'  => function ($row) {
                    if ($row->site) {
                        return sprintf(
                            '%s (ИД: %s)',
                            $row->site->name,
                            $row->site->id
                        );
                    }
            
                    return '---';
                },
                'vAlign' => 'middle',
            ],
            [
                'label'  => '',
                'format' => 'raw',
                'value'  => function ($row) {
                    $items = [
                        [
                            'label' => 'Значения',
                            'url'   => Url::to([
                                '/domains/values/default/index',
                                //'catalogId' => $catalogId,
                                'entityId'  => $row->id,
                            ]),
                        ],
                        [
                            'label' => 'Демо',
                            'url'   => Url::to([
                                'demo',
                                //'catalogId' => $catalogId,
                                'entityId'  => $row->id,
                            ]),
                        ],
                        '<div class="dropdown-divider"></div>',
                        [
                            'label' => 'Редактировать',
                            'url'   => Url::to([
                                'update',
                                //'catalogId' => $catalogId,
                                'entityId'  => $row->id,
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
                },
                'width'  => '80px',
                'vAlign' => 'middle',
            ],
        ];
    }
    
}
