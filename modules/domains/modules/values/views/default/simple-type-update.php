<?php declare(strict_types = 1);

use modules\domains\BaseTable;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View   $this
 * @var BaseTable $model
 * @var string $title
 * @var string $indexTitle
 * @var int    $catalogId
 * @var int    $entityId
 * @var string $typeName
 * @var string $attributeName
 * @var array  $dictionaries
 */

$viewName    = "{$title}. Редактирование";
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
    'label' => $indexTitle,
    'url'   => ['/domains/entity/default/index', 'catalogId' => $catalogId],
];
$this->params['breadcrumbs'][] = [
    'label' => $title,
    'url'   => [
        '/domains/value/default/index',
        'catalogId' => $catalogId,
        'entityId'  => $entityId,
    ],
];
$this->params['breadcrumbs'][] = 'Редактирование';

echo Html::tag('h2', 'Редактирование значения') . '<br>';

$form = ActiveForm::begin();

echo Html::tag('h5', 'Атрибут: ' . $attributeName);
echo Html::tag('h5', 'Тип значения: ' . $typeName);

echo $this->render('_form_' . $typeName, [
    'model'        => $model,
    'form'         => $form,
    'dictionaries' => $dictionaries,
]);

echo Html::tag(
    'div',
    Html::submitButton('Сохранить', ['class' => 'btn btn-success'])
);

ActiveForm::end();
