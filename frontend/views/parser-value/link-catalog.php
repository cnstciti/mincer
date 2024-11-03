<?php declare(strict_types = 1);

use frontend\models\parser_entity\LinkCatalogForm;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\web\View;
use yii\bootstrap5\ActiveForm;

/**
 * @var View            $this
 * @var LinkCatalogForm $model
 * @var string          $indexTitle
 * @var array           $catalogs
 */

$title       = 'Привязка к каталогу';
$this->title = sprintf('%s :: %s', Yii::$app->name, $title);

$this->params['breadcrumbs'][] = [
    'label' => $indexTitle,
    'url'   => ['index'],
];
$this->params['breadcrumbs'][] = $title;

echo Html::tag('h1', $title);

$form = ActiveForm::begin();

?>
    <div class="row">
        <div class="col-5">
            <?php
            
            try {
                echo $form->field($model, 'catalogId')
                          ->widget(Select2::class, [
                              'data'          => $catalogs,
                              'options'       => ['placeholder' => 'Выберите каталог ...'],
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
            
            echo Html::tag(
                'div',
                Html::submitButton('Сохранить', ['class' => 'btn btn-success'])
            );
            
            ?>
        </div>
    </div>
<?php

ActiveForm::end();
