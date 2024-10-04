<?php declare(strict_types=1);

use modules\domains\modules\dictionary_content\models\DictionaryContentForm;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View                  $this
 * @var DictionaryContentForm $model
 * @var string                $dictionaryName
 */

$title       = "{$dictionaryName}. Редактирование содержания словаря";
$this->title = sprintf(
    '%s :: %s',
    Yii::$app->name,
    $title
);

$this->params['breadcrumbs'][] = [
    'label' => 'Словари',
    'url'   => ['/domains/dictionary/default/index'],
];
$this->params['breadcrumbs'][] = [
    'label' => $dictionaryName . '. Содержания словаря',
    'url'   => ['index', 'dictionaryId' => $model->dictionaryId],
];
$this->params['breadcrumbs'][] = 'Редактирование содержания словаря';

echo Html::tag('h1', $title);

echo $this->render('_form', [
    'model' => $model,
]);
