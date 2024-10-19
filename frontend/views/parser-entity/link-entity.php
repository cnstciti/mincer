<?php declare(strict_types = 1);

use frontend\models\parser_entity\LinkEntityForm;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\web\View;
use yii\bootstrap5\ActiveForm;

/**
 * @var View           $this
 * @var LinkEntityForm $model
 * @var string         $indexTitle
 * @var string         $name
 * @var array          $entities
 */

$title       = 'Привязка к базовому продукту';
$this->title = sprintf('%s :: %s', Yii::$app->name, $title);

$this->params['breadcrumbs'][] = [
    'label' => $indexTitle,
    'url'   => ['index'],
];
$this->params['breadcrumbs'][] = $title;

echo Html::tag('h1', $title);
echo Html::tag('p', "Продукт: <b>{$name}</b>", ['class' => 'pt-3 pb-2']);

$form = ActiveForm::begin();

?>
    <div class="row">
        <div class="col">
            <?php
            
            try {
                echo $form->field($model, 'entityId')
                          ->widget(Select2::class, [
                              'data'          => $entities,
                              'options'       => ['placeholder' => 'Выберите продукт ...'],
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

            echo $form->field($model, 'isBaseEntity')->checkbox([
                'template' => '<div class="col">{input} {label}</div><div class="col-md-6">{error}</div>',
                'checked' => $model->isBaseEntity ? true : false,
            ]);

            echo Html::tag(
                'div',
                Html::submitButton('Сохранить', ['class' => 'btn btn-success'])
            );
            
            ?>
        </div>
    </div>
<?php

ActiveForm::end();
