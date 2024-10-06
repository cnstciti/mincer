<?php declare(strict_types = 1);

use modules\domains\modules\attribute\models\AttributeForm;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View              $this
 * @var AttributeForm     $attributeModel
 * @var string            $title
 * @var int               $catalogId
 * @var array             $units
 * @var array             $dictionaries
 * @var array             $types
 */

$viewName = 'Редактирование атрибута';
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
    'label' => $title,
    'url'   => ['/domains/attribute/default/index', 'catalogId' => $catalogId],
];
$this->params['breadcrumbs'][] = $viewName;

echo Html::tag('h1', $viewName);

echo $this->render('_form', [
    'attributeModel'     => $attributeModel,
    'units'              => $units,
    'dictionaries'       => $dictionaries,
    'types'              => $types,
]);
