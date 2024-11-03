<?php

namespace console\controllers;

use console\models\Megamarket\Megamarket;
use console\models\ParserData;
use yii\console\Controller;

class ParserController extends Controller
{
    
    /**
     * Загрузка данных с файлов Megamarket
     */
    public function actionMegamarket()
    {
        (new Megamarket)->run();
    }
    
    /**
     * Проверка привязанности объектов парсера
     */
    public function actionCheck()
    {
        (new ParserData)->check();
    }
    
    /**
     * Загрузка данных из парсера
     */
    public function actionLoadingFromParser()
    {
        (new ParserData)->loadingFromParser();
    }
    
}
