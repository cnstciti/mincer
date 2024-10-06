<?php declare(strict_types = 1);

use kartik\select2\Select2;
use modules\domains\modules\attribute\models\AttributeSelectForm;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View                $this
 * @var AttributeSelectForm $model
 * @var string              $title
 * @var int                 $catalogId
 * @var array               $attributes
 */

$viewName = 'Выбор существующего атрибута';
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
    'url'   => ['/domains/attribute/default/index', 'catalogId' => $catalogId],
];
$this->params['breadcrumbs'][] = $viewName;

echo Html::tag('h1', $viewName);

$form = ActiveForm::begin();

try {
    echo $form->field($model, 'attributeId')->widget(Select2::class, [
        'data'          => $attributes,
        'options'       => ['placeholder' => 'Выберите существующий атрибут ...',],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]);
} catch (Throwable $e) {
    echo 'Оишбка в Select2 (attributeId). ' . $e->getMessage();
}

echo Html::tag(
    'div',
    Html::submitButton('Сохранить', ['class' => 'btn btn-success'])
);

ActiveForm::end();
