<?php declare(strict_types = 1);

use modules\domains\modules\dictionary\models\DictionaryForm;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View           $this
 * @var DictionaryForm $model
 * @var ActiveForm     $form
 */

$form = ActiveForm::begin();

echo $form->field($model, 'name')->textInput(['maxlength' => true]);

//echo $form->field($model, 'isDelete')->checkbox();

echo Html::tag(
    'div',
    Html::submitButton('Сохранить', ['class' => 'btn btn-success'])
);

ActiveForm::end();