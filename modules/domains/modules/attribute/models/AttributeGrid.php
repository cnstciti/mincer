<?php declare(strict_types = 1);

namespace modules\domains\modules\attribute\models;

use kartik\bs5dropdown\ButtonDropdown;
use modules\domains\BaseGrid;
use Throwable;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;

class AttributeGrid extends BaseGrid
{
    
    /**
     * Возвращает грид
     *
     * @param AttributeSearch    $searchModel
     * @param ActiveDataProvider $dataProvider
     * @param string             $title
     * @param bool               $isEdit
     * @param int                $catalogId
     *
     * @return string
     * @throws Throwable
     */
    public static function get(
        AttributeSearch $searchModel,
        ActiveDataProvider $dataProvider,
        string $title,
        bool $isEdit,
        int $catalogId
    ): string
    {
        self::$panelHeading   = $title;
        self::$toolbarContent = $isEdit
            ? Html::a(
                'Создать атрибут',
                ['create', 'catalogId' => $catalogId],
                ['class' => 'btn btn-outline-success']
            )
              . Html::a(
                'Выбрать существующий атрибут',
                ['select', 'catalogId' => $catalogId],
                ['class' => 'btn btn-outline-success',]
            )
            : '';
        
        return self::widget([
            'dataProvider' => $dataProvider,
            'filterModel'  => $searchModel,
            'columns'      => self::columns($isEdit, $catalogId),
        ]);
    }
    
    /**
     * Возвращает колонки грида
     *
     * @param bool $isEdit
     * @param int  $catalogId
     *
     * @return array
     */
    private static function columns(bool $isEdit, int $catalogId): array
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
                'label'     => 'Тип',
                'attribute' => 'type.name',
                'vAlign'    => 'middle',
            ],
            [
                'label'     => 'Единица измерения',
                'attribute' => 'unit.name',
                'vAlign'    => 'middle',
            ],
            [
                'label'     => 'Словарь',
                'attribute' => 'dictionary.name',
                'vAlign'    => 'middle',
            ],
            /*[
                'attribute' => 'isDelete',
                'width'     => '80px',
                'vAlign'    => 'middle',
            ],*/
            [
                'format' => 'raw',
                'value'  => function ($row) use ($isEdit, $catalogId) {
                    $items = $isEdit
                        ? [
                            [
                                'label' => 'Редактировать',
                                'url'   => Url::to([
                                    'update',
                                    'catalogId'   => $catalogId,
                                    'attributeId' => $row->id,
                                ]),
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
