<?php declare(strict_types = 1);

use modules\domains\modules\type_value\models\TypeValueForm;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View          $this
 * @var TypeValueForm $model
 * @var string        $indexTitle
 */

$title       = "{$model->name}. Редактирование типа значения";
$this->title = sprintf(
    '%s :: %s',
    Yii::$app->name,
    $title
);

$this->params['breadcrumbs'][] = [
    'label' => $indexTitle,
    'url'   => ['index'],
];
$this->params['breadcrumbs'][] = $title;

echo Html::tag('h1', $title);

echo $this->render('_form', [
    'model' => $model,
]);
