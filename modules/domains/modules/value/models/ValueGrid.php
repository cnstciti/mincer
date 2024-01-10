<?php declare(strict_types = 1);

namespace modules\domains\modules\value\models;

use kartik\bs5dropdown\ButtonDropdown;
use modules\domains\BaseGrid;
use Throwable;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use yii\helpers\Url;

class ValueGrid extends BaseGrid
{
    
    /**
     * Возвращает грид
     *
     * @param ActiveDataProvider $dataProvider
     * @param string             $title
     * @param int                $catalogId
     * @param int                $entityId
     * @param array              $valueAttributes
     *
     * @return string
     * @throws Throwable
     */
    public static function get(
        SqlDataProvider $dataProvider,
        string $title,
        int $catalogId,
        int $entityId,
        array $valueAttributes
    ): string {
        self::$panelHeading = $title;
        
        return self::widget([
            'dataProvider' => $dataProvider,
            'filterModel'  => '',
            'columns'      => self::columns($entityId, $catalogId, $valueAttributes),
        ]);
    }
    
    /**
     * Возвращает колонки грида
     *
     * @return array
     */
    private static function columns(int $entityId, int $catalogId, array $valueAttributes): array
    {
        return [
            [
                'label'  => 'ИД<br>атрибута',
                'encodeLabel' => false,
                'attribute'   => 'attributeId',
                'vAlign' => 'middle',
            ],
            [
                'label'  => 'ИД<br>значения',
                'encodeLabel' => false,
                'attribute'   => 'valueId',
                'vAlign' => 'middle',
            ],
            [
                'label'  => "Значение",
                'attribute'   => 'value',
                'vAlign' => 'middle',
            ],
            [
                'label'       => "Наименование<br>атрибута",
                'encodeLabel' => false,
                'attribute'   => 'attributeName',
                'vAlign'      => 'middle',
            ],
            [
                'label'       => "Тип<br>атрибута",
                'encodeLabel' => false,
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
                'label'       => "Признак<br>удаления",
                'encodeLabel' => false,
                'attribute' => 'isDelete',
                'vAlign'    => 'middle',
            ],
           /*[
                'label'  => '',
                'format' => 'raw',
                'value'  => function ($row) use ($catalogId, $entityId, $valueAttributes) {
                    $column = array_column($valueAttributes, 'attributeId');
                    $key    = array_search($row->id, $column);
                    
                    if ($key === false) {
                        return '';
                    }
                    
                    $items = [
                        [
                            'label' => 'Редактировать',
                            'url'   => Url::to([
                                'update',
                                'typeValueId'        => $row['typeValueId'],
                                'valueId'            => $valueAttributes[$key]['id'],
                                'entityId'           => $entityId,
                                'catalogId'          => $catalogId,
                                'catalogAttributeId' => $valueAttributes[$key]['ca_id'],
                                'dictionaryId'       => $row['dictionaryId'] ?? 0,
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
            ],*/
        ];
    }
    
}
