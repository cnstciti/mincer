<?php declare(strict_types = 1);

use modules\domains\modules\value_text\models\ValueTextTable;
use yii\bootstrap5\ActiveForm;
use yii\web\View;

/**
 * @var View          $this
 * @var ValueTextTable $model
 * @var ActiveForm    $form
 */

echo $form->field($model, 'value')->textarea([
    'rows' => '10'
]);
