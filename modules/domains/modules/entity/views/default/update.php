<?php declare(strict_types = 1);

use modules\domains\modules\entity\models\EntityForm;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View       $this
 * @var EntityForm $model
 * @var string     $title
 * @var int        $catalogId
 */

$viewName    = $model->name . '. Редактирование продукта';
$this->title = sprintf(
    '%s :: %s',
    Yii::$app->name,
    $title
);

$this->params['breadcrumbs'][] = [
    'label' => 'Каталоги',
    'url'   => ['/domains/catalog/default/index'],
];
$this->params['breadcrumbs'][] = [
    'label' => $title,
    'url'   => ['/domains/entity/default/index', 'catalogId' => $catalogId],
];
$this->params['breadcrumbs'][] = $viewName;

echo Html::tag('h1', $viewName);

echo $this->render('_form', [
    'model' => $model,
]);
