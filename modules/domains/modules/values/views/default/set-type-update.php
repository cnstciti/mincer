<?php declare(strict_types = 1);

use kartik\select2\Select2;
use modules\domains\modules\value_set\models\ValueSetTable;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View          $this
 * @var ValueSetTable $model
 * @var string        $title
 * @var string        $indexTitle
 * @var int           $catalogId
 * @var int           $entityId
 * @var string        $attributeName
 * @var array         $dictionaries
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
        '/domains/value/default/index',
        'catalogId' => $catalogId,
        'entityId'  => $entityId,
    ],
];
$this->params['breadcrumbs'][] = 'Редактирование';

echo Html::tag('h2', $viewName) . '<br>';

$form = ActiveForm::begin();

echo Html::tag('h5', 'Атрибут: ' . $attributeName);
echo Html::tag('h5', 'Тип значения: set');

try {
    echo $form->field($model, 'dictionaryContentId')
              ->widget(Select2::class, [
                      'data'          => $dictionaries,
                      'maintai_nOrder' => true,
                      'options'       => [
                          'placeholder' => 'Выберите значения ...',
                          'multiple'    => true,
                      ],
                      'pluginOptions' => [
                          'tags'            => true,
                          'tokenSeparators' => [', '],
                          'allowClear'      => true,
                      ],
                  ]
              );
} catch (Throwable $e) {
    echo Html::tag(
        'div',
        'Ошибка создания Select2. ' . $e->getMessage(),
        ['class' => 'text-bg-danger p-3 mb-3']
    );
}

echo Html::tag(
    'div',
    Html::submitButton('Сохранить', ['class' => 'btn btn-success'])
);

ActiveForm::end();
