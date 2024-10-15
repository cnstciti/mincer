<?php declare(strict_types = 1);

use modules\domains\modules\value_float\models\ValueFloatTable;
use yii\bootstrap5\ActiveForm;
use yii\web\View;

/**
 * @var View            $this
 * @var ValueFloatTable $model
 * @var ActiveForm      $form
 */

echo $form->field($model, 'value')->textInput([
    'type' => 'number',
    'step' => 'any',
]);