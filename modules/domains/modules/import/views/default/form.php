<?php declare(strict_types=1);

use modules\domains\models\import\ImportForm;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var string $title
 * @var ImportForm $model
 */

$this->title = sprintf(
    '%s :: %s',
    Yii::$app->name,
    $title
);

$this->params['breadcrumbs'][] = [
    'label' => 'Каталоги',
    'url' => ['/domains/catalog/default/index']
];
$this->params['breadcrumbs'][] = $title;

echo Html::tag('h2', $title);

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);

echo $form->field($model, 'file')->fileInput();

echo Html::tag('button', 'Загрузить');

ActiveForm::end();
