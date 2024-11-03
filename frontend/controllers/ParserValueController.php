<?php

namespace frontend\controllers;

use Exception;
use frontend\models\parser_attribute\ParserAttributeService;
use frontend\models\parser_entity\ParserEntityService;
use frontend\models\parser_simple_type\LinkEnumForm;
use frontend\models\parser_simple_type\ParserSimpleTypeService;
use frontend\models\parser_value\ParserValueService;
use modules\domains\modules\attribute\models\AttributeService;
use modules\domains\modules\dictionary_content\models\DictionaryContentService;
use yii\web\Controller;

class ParserValueController extends Controller
{
    
    /**
     * @throws \Throwable
     */
    public function actionIndex(int $parserEntityId)
    {
        $entityService = new ParserEntityService();
        
        $entityTitle = $entityService->title();
        
        //$service = new ParserValueService();
        
        //$title = $service->title();
        $title = 'Парсер. Значения';
        
        /*$grid  = $service->getGrid(
            $this->request->queryParams,
            $title,
        );*/
        
        return $this->render('index', [
            'title'       => $title,
            'simpleTypeGrid' => (new ParserSimpleTypeService)->getGrid(
                $this->request->queryParams,
                $title . '. Простые типы'
                /*,
                $entityId,
                $catalogId*/
            ),
            /*'setTypeGrid'    => (new SetTypeService)->getGrid(
                new SetTypeSearch(),
                $this->request->queryParams,
                $title . '. Списочные типы'
            ),
            'imgTypeGrid'    => (new ImageTypeService)->getGrid(
                new ImageTypeSearch(),
                $this->request->queryParams,
                $title . '. Изображения'
            ),*/
            'entityTitle' => $entityTitle,
        ]);
    }
    
    public function actionLinkEnum(int $valueId, int $parserEntityId, int $dictionaryId/*, int $catalogId*/)
    {
        $entityService = new ParserEntityService();
    
        $entityTitle = $entityService->title();

        //$service = new ParserSimpleTypeService();
        
        //$model      = $service->getLinkAttributeForm($id);
        $model      = LinkEnumForm::findOne($valueId);
        //$indexTitle = $service->title();
        $indexTitle = 'Парсер. Значения';
        $dictionaryContents = (new DictionaryContentService)->dataForSelect2($dictionaryId);
        
        if ($this->request->isPost
            //&& $model->validate()
            && $model->load($this->request->post())
            && $model->save()
        ) {
            return $this->redirect(['index', 'parserEntityId' => $parserEntityId]);
        }
    
        return $this->render('link-enum', [
            'model'              => $model,
            'indexTitle'         => $indexTitle,
            'dictionaryContents' => $dictionaryContents,
            'entityTitle'        => $entityTitle,
            'parserEntityId'     => $parserEntityId,
        ]);
    }
    
}
