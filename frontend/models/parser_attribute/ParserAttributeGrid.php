<?php declare(strict_types = 1);

namespace frontend\models\parser_attribute;

use kartik\bs5dropdown\ButtonDropdown;
use modules\domains\BaseGrid;
use Throwable;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

class ParserAttributeGrid extends BaseGrid
{
    
    /**
     * Возвращает грид
     * @param ParserAttributeSearch $searchModel
     * @param ActiveDataProvider    $dataProvider
     * @param string                $title
     * @return string
     * @throws Throwable
     */
    public static function get(
        ParserAttributeSearch $searchModel,
        ActiveDataProvider $dataProvider,
        string $title,
        int $catalogId
    ): string
    {
        self::$panelHeading = $title;
        
        return self::widget([
            'dataProvider' => $dataProvider,
            'filterModel'  => $searchModel,
            'columns'      => self::columns($catalogId),
        ]);
    }
    
    /**
     * Возвращает колонки грида
     * @return array
     */
    private static function columns(int $catalogId): array
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
                'label'  => 'Базовый атрибут',
                'format' => 'raw',
                'value'  => function ($row) {
                    if ($row->attributeId) {
                        return sprintf(
                            '%s (ИД: %s)',
                            $row->attr->name,
                            $row->attr->id
                        );
                    }
                    
                    return '---';
                },
                'vAlign' => 'middle',
            ],
            [
                'attribute' => 'status',
                'vAlign'    => 'middle',
            ],
            [
                'label'  => '',
                'format' => 'raw',
                'value'  => function ($row) use ($catalogId) {
                    $items = [
                        [
                            'label' => 'Привязать к атрибуту',
                            'url'   => Url::to([
                                'link-attribute',
                                'id'        => $row->id,
                                'catalogId' => $catalogId,
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
