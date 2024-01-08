<?php declare(strict_types=1);

/**
 * @var yii\web\View $this
 * @var string $title
 */

use yii\helpers\Html;

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

echo Html::tag('h2', $title);

echo Html::tag('p', 'Данные успешно загружены!');

