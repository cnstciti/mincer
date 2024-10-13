<?php declare(strict_types = 1);

use kartik\select2\Select2;
use modules\domains\modules\simple_type\models\SimpleTypeSelectForm;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var SimpleTypeSelectForm $model
 * @var View   $this
 * @var string $title
 * @var string $indexTitle
 * @var int    $catalogId
 * @var int    $entityId
 * @var array  $entities
 */

$viewName    = "{$title}. Скопировать все значения";
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
$this->params['breadcrumbs'][] = 'Скопировать все значения';

echo Html::tag('h2', 'Скопировать все значения') . '<br>';

$form = ActiveForm::begin();

try {
    echo $form->field($model, 'selectEntity')
              ->widget(Select2::class, [
                  'data'          => $entities,
                  'options'       => [
                      'placeholder' => 'Выберите продукт ...',
                  ],
                  'pluginOptions' => [
                      'allowClear' => true,
                  ],
              ])->label(false);
} catch (Throwable $e) {
    echo Html::tag(
        'div',
        'Ошибка создания Select2. ' . $e->getMessage(),
        ['class' => 'text-bg-danger p-3 mb-3']
    );
}

echo Html::tag(
    'div',
    Html::submitButton('Скопировать', ['class' => 'btn btn-success'])
);

ActiveForm::end();
