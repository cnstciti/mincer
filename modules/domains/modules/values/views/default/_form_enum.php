<?php declare(strict_types = 1);

use kartik\select2\Select2;
use modules\domains\modules\value_enum\models\ValueEnumTable;
use yii\bootstrap5\ActiveForm;
use yii\web\View;

/**
 * @var View          $this
 * @var ValueEnumTable $model
 * @var ActiveForm    $form
 * @var array         $dictionaries
 */

try {
    echo $form->field($model, 'dictionaryContentId')
              ->widget(Select2::class, [
                      'data'          => $dictionaries,
                      'maintainOrder' => true,
                      'options'       => [
                          'placeholder' => 'Выберите значение ...',
                      ],
                  ]
              );
} catch (Throwable $e) {
    throw new Exception('Ошибка создания Select2. ' . $e->getMessage());
}