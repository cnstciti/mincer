<?php declare(strict_types = 1);

use frontend\models\parser_entity\LinkEntityForm;
use frontend\models\parser_simple_type\LinkEnumForm;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\web\View;
use yii\bootstrap5\ActiveForm;

/**
 * @var View         $this
 * @var LinkEnumForm $model
 * @var string       $indexTitle
 * @var array        $dictionaryContents
 * @var string       $entityTitle
 * @var int          $parserEntityId
 */

$title       = 'Привязка к содержимому словаря';
$this->title = sprintf('%s :: %s', Yii::$app->name, $title);

$this->params['breadcrumbs'][] = [
    'label' => $entityTitle,
    'url'   => ['/parser-entity/index'],
];
$this->params['breadcrumbs'][] = [
    'label' => $indexTitle,
    'url'   => ['/parser-value/index', 'parserEntityId' => $parserEntityId],
];
$this->params['breadcrumbs'][] = $title;

echo Html::tag('h1', $title);
//echo Html::tag('p', "Продукт: <b>{$name}</b>", ['class' => 'pt-3 pb-2']);

$form = ActiveForm::begin();

?>
    <div class="row">
        <div class="col">
            <?php
            
            try {
                echo $form->field($model, 'dictionaryContentId')
                          ->widget(Select2::class, [
                              'data'          => $dictionaryContents,
                              'options'       => ['placeholder' => 'Выберите содержимое словаря ...'],
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
            /*
                        echo $form->field($model, 'isBaseEntity')->checkbox([
                            'template' => '<div class="col">{input} {label}</div><div class="col-md-6">{error}</div>',
                            'checked' => $model->isBaseEntity ? true : false,
                        ]);
            */
            echo Html::tag(
                'div',
                Html::submitButton('Сохранить', ['class' => 'btn btn-success'])
            );
            
            ?>
        </div>
    </div>
<?php

ActiveForm::end();
