<?php declare(strict_types = 1);

namespace common\models\grids;

use kartik\grid\GridView;
use Throwable;

class BaseGrid extends GridView
{
    public static string $panelHeading = '';
    public static string $toolbarContent = '';
    
    
    /**
     * @param array $config
     *
     * @return string
     * @throws Throwable
     */
    public static function widget($config = []): string
    {
        return parent::widget([
            'dataProvider' => $config['dataProvider'],
            'filterModel'  => $config['filterModel'],
            'columns'      => $config['columns'],
            'hover'        => true,
            'panel'        => [
                'type'    => GridView::TYPE_PRIMARY,
                'heading' => '<h4 class="panel-title">' . self::$panelHeading . '</h4>',
            ],
            'toolbar'      => [
                [
                    'content' => self::$toolbarContent,
                ],
            ],
        ]);
    }
    
}
