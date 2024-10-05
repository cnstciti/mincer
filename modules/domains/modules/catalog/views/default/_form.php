<?php declare(strict_types = 1);

use kartik\select2\Select2;
use modules\domains\modules\catalog\models\CatalogForm;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\web\View;

/**
 * @var View        $this
 * @var ActiveForm  $form
 * @var CatalogForm $model
 * @var string      $indexTitle
 * @var array       $parents
 */

$form = ActiveForm::begin();

echo $form->field($model, 'name')->textInput(['maxlength' => true]);

try {
    echo $form->field($model, 'parentId')->widget(Select2::class, [
        'data'          => $parents,
        'options'       => ['placeholder' => 'Выберите родительский каталог ...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]);
} catch (Exception $e) {
    echo "Ошика в виджете Select2. " . $e->getMessage();
}

echo $form->field($model, 'containsProducts')->checkbox();

//echo $form->field($model, 'isDelete')->checkbox();

echo Html::tag(
    'div',
    Html::submitButton('Сохранить', ['class' => 'btn btn-success'])
);

ActiveForm::end();