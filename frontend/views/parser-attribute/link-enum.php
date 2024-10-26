<?php declare(strict_types = 1);

use frontend\models\parser_entity\LinkCatalogForm;
use frontend\models\parser_simple_type\LinkEnumForm;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\web\View;
use yii\bootstrap5\ActiveForm;

/**
 * @var View            $this
 * @var LinkEnumForm $model
 * @var string          $indexTitle
 * @var array           $dictionaryContents
 * @var string          $entityTitle
 */

$title       = 'Привязка значения';
$this->title = sprintf('%s :: %s', Yii::$app->name, $title);

$this->params['breadcrumbs'][] = [
    'label' => $entityTitle,
    'url' => ['/parser-entity/index']
];
$this->params['breadcrumbs'][] = [
    'label' => $indexTitle,
    'url'   => ['index', 'catalogId' => $catalogId],
];
$this->params['breadcrumbs'][] = $title;

echo Html::tag('h1', $title);

echo Html::tag(
        'div',
        "Атрибут парсера: <b>$model->name</b>",
        ['class' => 'mb-2 mt-2']
);

$form = ActiveForm::begin();

?>
    <div class="row">
        <div class="col-5">
            <?php
            
            try {
                echo $form->field($model, 'attributeId')
                          ->widget(Select2::class, [
                              'data'          => $attributes,
                              'options'       => ['placeholder' => 'Выберите атрибут...'],
                              'pluginOptions' => [
                                  'allowClear' => true,
                              ],
                          ]);
            } catch (Exception $e) {
                echo Html::tag(
                    'div',
                    "Ошибка в виджете Select2. " . $e->getMessage(),
                    ['class' => 'text-bg-danger p-3 mb-3']
                );
            }

            echo $form->field($model, 'status')
                 ->textInput([
                     'maxlength' => true,
                     'id'        => 'name',
                 ])
            //     ->label(false)
            ;
            
            
            echo Html::tag(
                'div',
                Html::submitButton('Сохранить', ['class' => 'btn btn-success'])
            );
            
            ?>
        </div>
    </div>
<?php

ActiveForm::end();
