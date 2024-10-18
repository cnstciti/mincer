<?php declare(strict_types = 1);

namespace common\models\grids;

use common\models\searches\CatalogSearch;
use kartik\bs5dropdown\ButtonDropdown;
use Throwable;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;

class CatalogGrid extends BaseGrid
{
    
    /**
     * Возвращает грид
     *
     * @param CatalogSearch      $searchModel
     * @param ActiveDataProvider $dataProvider
     * @param string             $title
     * @param bool               $isEdit
     *
     * @return string
     * @throws Throwable
     */
    public static function get(
        CatalogSearch $searchModel,
        ActiveDataProvider $dataProvider,
        string $title,
        bool $isEdit
    ): string
    {
        self::$panelHeading   = $title;
        self::$toolbarContent = $isEdit
            ? Html::a(
                'Создать каталог',
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
     * @param bool $isEdit
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
                'attribute' => 'name',
                'vAlign'    => 'middle',
            ],
            [
                'label'  => 'Родительский каталог',
                'format' => 'raw',
                'value'  => function ($row) {
                    if ($row->parent) {
                        return sprintf(
                            '%s (ИД: %s)',
                            $row->parent->name,
                            $row->parent->id
                        );
                    }
                    
                    return '---';
                },
                'vAlign' => 'middle',
            ],
            [
                'attribute' => 'containsProducts',
                'vAlign'    => 'middle',
            ],
            [
                'format' => 'raw',
                'value'  => function ($row) use ($isEdit) {
                    $editItems = [];
                    if ($isEdit) {
                        $editItems = [
                            [
                                'label' => 'Редактировать',
                                'url'   => Url::to([
                                    'update',
                                    'catalogId' => $row->id,
                                ]),
                            ],
                        ];
                    }
    
                    $items = [];
                    if ($row->containsProducts) {
                        $items = [
                            '<div class="dropdown-divider"></div>',
                            [
                                'label' => 'Атрибуты',
                                'url'   => Url::to([
                                    '/attribute/index',
                                    'catalogId' => $row->id,
                                ]),
                            ],
                            [
                                'label' => 'Продукты',
                                'url'   => Url::to([
                                    '/entity/index',
                                    'catalogId' => $row->id,
                                ]),
                            ],
                            /* '<div class="dropdown-divider"></div>',
                             [
                                 'label' => 'Экспорт шаблона',
                                 'url'   => Url::to([
                                     '/domains/export/default/template',
                                     'catalogId' => $row->id,
                                 ]),
                             ],
                             [
                                 'label' => 'Экспорт данных',
                                 'url'   => Url::to([
                                     '/domains/export/default/data',
                                     'catalogId' => $row->id,
                                 ]),
                             ],*/
                        ];
                    }
                    
                    if ($items) {
                        $items = array_merge($editItems, $items);
                    } else {
                        $items = $editItems;
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
