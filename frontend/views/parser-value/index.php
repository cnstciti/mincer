<?php declare(strict_types=1);

use kartik\tabs\TabsX;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var string $title
 * @var string $simpleTypeGrid
 * @var string $setTypeGrid
 * @var string $imgTypeGrid
 * @var string $entityTitle
 */

$this->title = sprintf('%s :: %s', Yii::$app->name, $title);

$this->params['breadcrumbs'][] = [
    'label' => $entityTitle,
    'url' => ['/parser-entity/index']
];
$this->params['breadcrumbs'][] = $title;

$items = [
    [
        'label'   => 'Простые типы',
        'content' => $simpleTypeGrid,
        'active'  => true,
    ],
    /*[
        'label'   => 'Списочные типы',
        'content' => $setTypeGrid,
    ],
    [
        'label'   => 'Изображения',
        'content' => $imgTypeGrid,
    ],*/
];

try {
    echo TabsX::widget([
        'items'        => $items,
        'position'     => TabsX::POS_LEFT,
        'sideways'     => true,
        'encodeLabels' => false,
        'bordered'     => true,
    ]);
} catch (Throwable $e) {
    echo Html::tag(
        'div',
        'Ошибка создания TabsX. ' . $e->getMessage(),
        ['class' => 'text-bg-danger p-3 mb-3']
    );
}