<?php

namespace frontend\controllers;

use frontend\models\parser_entity\ParserEntitySearch;
use frontend\models\parser_entity\ParserEntityService;
use yii\web\Controller;

class ParserEntityController extends Controller
{
    public function actionIndex(): string
    {
        $service = new ParserEntityService();
        //$title = $this->getCatalogEntityTitle($catalogId);
        
        return $this->render('index', [
            //'title' => $title,
            'grid'  => $service->getGrid(
                new ParserEntitySearch(),
                $this->request->queryParams,
                'sss',
                //$title,
                ),
        ]);
    }
}
