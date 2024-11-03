<?php

namespace frontend\controllers;

use console\models\Megamarket\Megamarket;
use yii\web\Controller;

class TestController extends Controller
{

    public function actionIndex()
    {
        (new Megamarket)->run();
    }
}
