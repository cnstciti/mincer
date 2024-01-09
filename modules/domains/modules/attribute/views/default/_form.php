<?php declare(strict_types = 1);

use modules\domains\modules\attribute\models\AttributeForm;
use modules\domains\modules\attribute\models\FullNameParamForm;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\web\View;

/**
 * @var View              $this
 * @var AttributeForm     $attributeModel
 * @var FullNameParamForm $fullNameParamModel
 * @var ActiveForm        $form
 * @var array             $units
 * @var array             $dictionaries
 * @var array             $types
 */

?>

<?php $form = ActiveForm::begin(); ?>

<div class="row">
    <div class="col-6 border border-secondary-subtle">
        <h5 class="mt-2 mb-3">Характеристики атрибута</h5>

        <div class="row g-3 align-items-start">
            <div class="col-3">
                <label for="name" class="col-form-label">Наименование</label>
            </div>
            <div class="col">
                <?= $form->field($attributeModel, 'name')
                         ->textInput([
                             'maxlength' => true,
                             'id'        => 'name',
                         ])
                         ->label(false)
                ?>
            </div>
        </div>

        <div class="row g-3 align-items-start">
            <div class="col-3">
                <label for="description" class="col-form-label">Описание</label>
            </div>
            <div class="col">
                <?= $form->field($attributeModel, 'description')
                         ->textInput([
                             'maxlength' => true,
                             'id'        => 'description',
                         ])
                         ->label(false)
                ?>
            </div>
        </div>

        <div class="row g-3 align-items-start">
            <div class="col-3">
                <label class="col-form-label">Ед/измерения</label>
            </div>
            <div class="col">
                <?= $form->field($attributeModel, 'unitId')
                         ->widget(Select2::class, [
                             'data'          => $units,
                             'options'       => [
                                 'placeholder' => 'Выберите единицу измерения ...',
                             ],
                             'pluginOptions' => [
                                 'allowClear' => true,
                             ],
                         ])->label(false) ?>
            </div>
        </div>

        <div class="row g-3 align-items-start">
            <div class="col-3">
                <label class="col-form-label">Словарь</label>
            </div>
            <div class="col">
                <?= $form->field($attributeModel, 'dictionaryId')
                         ->widget(Select2::class, [
                             'data'          => $dictionaries,
                             'options'       => [
                                 'placeholder' => 'Выберите словарь ...',
                             ],
                             'pluginOptions' => [
                                 'allowClear' => true,
                             ],
                         ])->label(false) ?>
            </div>
        </div>

        <div class="row g-3 align-items-start">
            <div class="col-3">
                <label class="col-form-label">Тип значения</label>
            </div>
            <div class="col">
                <?= $form->field($attributeModel, 'typeValueId')
                         ->widget(Select2::class, [
                             'data'          => $types,
                             'options'       => [
                                 'placeholder' => 'Выберите тип значения ...',
                             ],
                             'pluginOptions' => [
                                 'allowClear' => true,
                             ],
                         ])->label(false) ?>
            </div>
        </div>
        
        <?= $form->field($attributeModel, 'isDelete')->checkbox() ?>

    </div>
    <div class="col-6 border border-secondary-subtle">
        <h5 class="mt-2 mb-3">Характеристики формирования полного наименования</h5>

        <div class="row g-3 align-items-start">
            <div class="col-5">
                <label for="sequenceNumber" class="col-form-label">Порядковый номер атрибута</label>
            </div>
            <div class="col">
                <?= $form->field($fullNameParamModel, 'sequenceNumber')
                         ->textInput([
                             'maxlength' => true,
                             'id'        => 'sequenceNumber',
                         ])
                         ->label(false)
                ?>
            </div>
        </div>
    </div>
    
</div>

<div class="form-group mt-3">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>
