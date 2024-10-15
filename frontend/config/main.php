<?php

use yii\log\FileTarget;

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'name'                => 'Mincer',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
        'modules'             => [
        'domains' => [
            'class'   => 'modules\domains\Module',
            'modules' => [
                'unit'       => [
                    'class' => 'modules\domains\modules\unit\Module',
                ],
                'type_value' => [
                    'class' => 'modules\domains\modules\type_value\Module',
                ],
                'dictionary' => [
                    'class' => 'modules\domains\modules\dictionary\Module',
                ],
                'dictionary_content' => [
                    'class' => 'modules\domains\modules\dictionary_content\Module',
                ],
                'catalog' => [
                    'class' => 'modules\domains\modules\catalog\Module',
                ],
                'attribute' => [
                    'class' => 'modules\domains\modules\attribute\Module',
                ],
                'entity' => [
                    'class' => 'modules\domains\modules\entity\Module',
                ],
                'catalog_attribute' => [
                    'class' => 'modules\domains\modules\catalog_attribute\Module',
                ],
                'catalog_entity' => [
                    'class' => 'modules\domains\modules\catalog_entity\Module',
                ],
                'eav' => [
                    'class' => 'modules\domains\modules\eav\Module',
                ],
                'value' => [
                    'class' => 'modules\domains\modules\value\Module',
                ],
                'simple_type' => [
                    'class' => 'modules\domains\modules\simple_type\Module',
                ],
                'value_int' => [
                    'class' => 'modules\domains\modules\value_int\Module',
                ],
                'value_float' => [
                    'class' => 'modules\domains\modules\value_float\Module',
                ],
                'value_string' => [
                    'class' => 'modules\domains\modules\value_string\Module',
                ],
                'value_text' => [
                    'class' => 'modules\domains\modules\value_text\Module',
                ],
                'value_enum' => [
                    'class' => 'modules\domains\modules\value_enum\Module',
                ],
                'set_type' => [
                    'class' => 'modules\domains\modules\set_type\Module',
                ],
                'value_image' => [
                    'class' => 'modules\domains\modules\value_image\Module',
                ],
                'image_type' => [
                    'class' => 'modules\domains\modules\image_type\Module',
                ],
                'values' => [
                    'class' => 'modules\domains\modules\values\Module',
                ],
              /*  'export' => [
                    'class' => 'modules\domains\modules\export\Module',
                ],
                'import' => [
                    'class' => 'modules\domains\modules\import\Module',
                ],*/
            ],
            'params'  => [
                'db'                    => 'db',        // база данных
                'editUnit'              => true,        // редактирование единиц измерения
                'editTypeValue'         => true,        // редактирование типов значений
                'editDictionary'        => true,        // редактирование словарей
                'editDictionaryContent' => true,        // редактирование содержимого словарей
                'editCatalog'           => true,        // редактирование каталога
                'editAttribute'         => true,        // редактирование атрибутов
                
                'checkIsExistId'        => true,   // проверять на существование значения isExistId == 1
                'importFromExcel'       => true,  // возможен ли импорт данных из Excel
                'accessExtraFunctions'  => false, // есть ли доступ к управлению описаниями, мультимедиа, изображениями
                'editAttributeGroup'    => true,    // редактирование групп атрибутов
                'showEntityReport'      => false,    // показ отчетов в продуктах
            ],
        ],
    ],

    'params' => $params,
];
