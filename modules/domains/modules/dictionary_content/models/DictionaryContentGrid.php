<?php declare(strict_types = 1);

namespace modules\domains\modules\dictionary_content\models;

use kartik\bs5dropdown\ButtonDropdown;
use modules\domains\BaseGrid;
use Throwable;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;

class DictionaryContentGrid extends BaseGrid
{
    
    /**
     * Возвращает грид
     *
     * @param DictionaryContentSearch $searchModel
     * @param ActiveDataProvider      $dataProvider
     * @param string                  $title
     * @param bool                    $isEdit
     * @param int                     $dictionaryId
     *
     * @return string
     * @throws Throwable
     */
    public static function get(
        DictionaryContentSearch $searchModel,
        ActiveDataProvider $dataProvider,
        string $title,
        bool $isEdit,
        int $dictionaryId
    ): string
    {
        self::$panelHeading   = $title;
        self::$toolbarContent = $isEdit
            ? Html::a(
                'Создать содержание словаря',
                ['create', 'dictionaryId' => $dictionaryId],
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
                'attribute' => 'value',
                'vAlign'    => 'middle',
            ],
            /*[
                'attribute' => 'isDelete',
                'width'     => '80px',
                'vAlign'    => 'middle',
            ],*/
            [
                'label'  => '',
                'format' => 'raw',
                'value'  => function ($row) use ($isEdit) {
                    $items = $isEdit
                        ? [
                            [
                                'label' => 'Редактировать',
                                'url'   => Url::to([
                                    'update',
                                    'dictionaryId'        => $row->dictionaryId,
                                    'dictionaryContentId' => $row->id,
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
