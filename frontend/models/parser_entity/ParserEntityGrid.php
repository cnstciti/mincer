<?php declare(strict_types = 1);

namespace frontend\models\parser_entity;

use kartik\bs5dropdown\ButtonDropdown;
use modules\domains\BaseGrid;
use Throwable;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

class ParserEntityGrid extends BaseGrid
{
    
    /**
     * Возвращает грид
     * @param ParserEntitySearch $searchModel
     * @param ActiveDataProvider $dataProvider
     * @param string             $title
     * @return string
     * @throws Throwable
     */
    public static function get(
        ParserEntitySearch $searchModel,
        ActiveDataProvider $dataProvider,
        string $title
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
     * @return array
     */
    private static function columns(): array
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
                    if ($row->catalogId) {
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
                'label'  => 'Базовый продукт',
                'format' => 'raw',
                'value'  => function ($row) {
                    if ($row->entityId) {
                        return sprintf(
                            '%s (ИД: %s)',
                            $row->entity->name,
                            $row->entity->id
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
                    if ($row->parserSiteId) {
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
                            'label' => 'Привязать к каталогу',
                            'url'   => Url::to([
                                'link-catalog',
                                'id' => $row->id,
                            ]),
                        ],
                    ];
                    
                    if ($row->catalogId) {
                        $entityItem = [
                            '<div class="dropdown-divider"></div>',
                            [
                                'label' => 'Привязать к продукту',
                                'url'   => Url::to([
                                    'link-entity',
                                    'id'        => $row->id,
                                    'catalogId' => $row->catalogId,
                                    'entityId'  => $row->entityId ?? 0,
                                ]),
                            ],
                        ];
                        
                        $items = array_merge($items, $entityItem);
                    }
                    
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
