<?php declare(strict_types = 1);

use common\models\forms\CatalogForm;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View        $this
 * @var CatalogForm $model
 * @var string      $indexTitle
 * @var array       $parents
 */

$title       = "{$model->name}. Редактирование каталога";
$this->title = sprintf('%s :: %s', Yii::$app->name, $title);

$this->params['breadcrumbs'][] = [
    'label' => $indexTitle,
    'url'   => ['index'],
];
$this->params['breadcrumbs'][] = $title;

echo Html::tag('h1', $title);

echo $this->render('_form', [
    'model'   => $model,
    'parents' => $parents,
]);
