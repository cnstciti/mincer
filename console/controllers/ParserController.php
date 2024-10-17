<?php

namespace console\controllers;

use console\models\Megamarket\Megamarket;
use yii\console\Controller;

class ParserController extends Controller
{

    public function actionMegamarket()
    {
        (new Megamarket)->run();
    }
    

}
