<?php declare(strict_types = 1);

use modules\domains\modules\value_int\models\ValueIntTable;
use yii\bootstrap5\ActiveForm;
use yii\web\View;

/**
 * @var View          $this
 * @var ValueIntTable $model
 * @var ActiveForm    $form
 */

echo $form->field($model, 'value')->textInput([
    'type' => 'number',
    'step' => 'any',
]);
