<?php declare(strict_types = 1);

use modules\domains\modules\entity\models\EntityForm;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\web\View;

/**
 * @var View       $this
 * @var EntityForm $model
 * @var ActiveForm $form
 */

$form = ActiveForm::begin();

echo $form->field($model, 'name')->textInput(['maxlength' => true]);

//echo $form->field($model, 'isDelete')->checkbox();

echo Html::tag(
    'div',
    Html::submitButton('Сохранить', ['class' => 'btn btn-success'])
);

ActiveForm::end();
