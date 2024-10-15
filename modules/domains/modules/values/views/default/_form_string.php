<?php declare(strict_types = 1);

use modules\domains\modules\value_string\models\ValueStringTable;
use yii\bootstrap5\ActiveForm;
use yii\web\View;

/**
 * @var View          $this
 * @var ValueStringTable $model
 * @var ActiveForm    $form
 */

echo $form->field($model, 'value')->textInput([
]);
