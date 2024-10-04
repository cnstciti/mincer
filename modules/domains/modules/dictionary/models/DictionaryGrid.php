<?php declare(strict_types = 1);

namespace modules\domains\modules\dictionary\models;

use kartik\bs5dropdown\ButtonDropdown;
use modules\domains\BaseGrid;
use Throwable;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;

class DictionaryGrid extends BaseGrid
{
    
    /**
     * Возвращает грид
     *
     * @param DictionarySearch   $searchModel
     * @param ActiveDataProvider $dataProvider
     * @param string             $title
     * @param bool               $isEdit
     *
     * @return string
     * @throws Throwable
     */
    public static function get(
        DictionarySearch $searchModel,
        ActiveDataProvider $dataProvider,
        string $title,
        bool $isEdit
    ): string
    {
        self::$panelHeading   = $title;
        self::$toolbarContent = $isEdit
            ? Html::a(
                'Создать словарь',
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
                    $items = [
                        [
                            'label' => 'Содержания',
                            'url'   => Url::to([
                                '/domains/dictionary_content/default/index',
                                'dictionaryId' => $row->id,
                            ]),
                        ],
                    ];
                    
                    if ($isEdit) {
                        $items = array_merge($items, [
                            '<div class="dropdown-divider"></div>',
                            [
                                'label' => 'Редактировать',
                                'url'   => Url::to([
                                    'update',
                                    'dictionaryId' => $row->id,
                                ]),
                            ],
                        ]);
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
