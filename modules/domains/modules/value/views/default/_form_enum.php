<?php declare(strict_types = 1);

use kartik\select2\Select2;
use modules\domains\modules\value\models\ValueIntTable;
use yii\bootstrap5\ActiveForm;
use yii\web\View;

/**
 * @var View          $this
 * @var ValueIntTable $model
 * @var ActiveForm    $form
 * @var array         $dictionaries
 */
/*
$values    = ValueSet::dictionaryContent($idEntity, $idAttribute);
$valuesSet = [];
foreach ($values as $value) {
    $valuesSet[] = $value['idDictionaryContent'];
}
*/
echo $form->field($model, 'dictionaryContentId')->widget(Select2::class, [
    'data'          => $dictionaries,
    'maintainOrder' => true,
    'options'       => [
        //'value'       => $valuesSet,
        'placeholder' => 'Выберите значение ...',
        //'multiple'    => true,
    ],
    'pluginOptions' => [
        //'tags'            => true,
        //'tokenSeparators' => [', '],
        'allowClear'      => true,
    ],
]);
