<?php declare(strict_types=1);

use yii\web\View;

/**
 * @var View $this
 * @var string $title
 * @var string $grid
 */

$this->title = sprintf(
    '%s :: %s',
    Yii::$app->name,
    $title
);

$this->params['breadcrumbs'][] = [
    'label' => 'Каталоги',
    'url' => ['/domains/catalog/default/index']
];
$this->params['breadcrumbs'][] = $title;

echo $grid;
