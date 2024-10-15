<?php declare(strict_types = 1);

use kartik\file\FileInput;
use modules\domains\modules\value_image\models\ValueImageTable;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View            $this
 * @var ValueImageTable $model
 * @var string          $title
 * @var string          $indexTitle
 * @var int             $catalogId
 * @var int             $entityId
 */

$viewName    = "{$title}. Редактирование";
$this->title = sprintf(
    '%s :: %s',
    Yii::$app->name,
    $title
);

$this->params['breadcrumbs'][] = [
    'label' => 'Каталоги',
    'url'   => ['/domains/catalog/default/index'],
];
$this->params['breadcrumbs'][] = [
    'label' => $indexTitle,
    'url'   => ['/domains/entity/default/index', 'catalogId' => $catalogId],
];
$this->params['breadcrumbs'][] = [
    'label' => $title,
    'url'   => [
        '/domains/values/default/index',
        'catalogId' => $catalogId,
        'entityId'  => $entityId,
    ],
];
$this->params['breadcrumbs'][] = 'Редактирование';

echo Html::tag('h2', $viewName) . '<br>';

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);

echo Html::tag('h5', 'Тип значения: img');

try {
    echo $form->field($model, 'file')
              ->widget(FileInput::class, [
                  'options'       => [
                      //'multiple' => true,
                      //'accept'   => 'image/*'
                  ],
                  'language'      => 'ru',
                  'pluginOptions' => [
                      'showRemove'  => false,
                      'showCaption' => false,
                      'showUpload'  => false,
                      'showClose'   => false,
                      'showCancel'  => false,
                      'browseLabel' => 'Выбрать изображение',
                  ],
              ]);
} catch (Exception $e) {
    throw new RuntimeException($e->getMessage());
}

echo Html::tag(
    'div',
    Html::submitButton('Загрузить', ['class' => 'btn btn-success'])
);

ActiveForm::end();
