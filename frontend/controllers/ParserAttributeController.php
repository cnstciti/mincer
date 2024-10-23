<?php

namespace frontend\controllers;

use Exception;
use frontend\models\parser_attribute\ParserAttributeService;
use frontend\models\parser_entity\ParserEntityService;
use modules\domains\modules\attribute\models\AttributeService;
use yii\web\Controller;

class ParserAttributeController extends Controller
{
    
    /**
     * @throws \Throwable
     */
    public function actionIndex(int $catalogId)
    {
        $entityService = new ParserEntityService();
        
        $entityTitle = $entityService->title();
        
        $service = new ParserAttributeService();
        
        $title = $service->title();
        $grid  = $service->getGrid(
            $this->request->queryParams,
            $title,
        );
        
        return $this->render('index', [
            'title'       => $title,
            'grid'        => $grid,
            'entityTitle' => $entityTitle,
        ]);
    }
    
    /**
     * Привязать товар к каталогу
     * @param int $entityId
     * @throws Exception
     */
    public function actionLinkAttribute(int $id, int $catalogId)
    {
        $entityService = new ParserEntityService();
    
        $entityTitle = $entityService->title();

        $service = new ParserAttributeService();
        
        $model      = $service->getLinkAttributeForm($id);
        $indexTitle = $service->title();
        $attributes = (new AttributeService)->dataForSelect2($catalogId);
        
        if ($this->request->isPost
            //&& $model->validate()
            && $model->load($this->request->post())
            && $model->save()
        ) {
            return $this->redirect(['index', 'catalogId' => $catalogId]);
        }
        
        return $this->render('link-attribute', [
            'model'       => $model,
            'indexTitle'  => $indexTitle,
            'attributes'  => $attributes,
            'entityTitle' => $entityTitle,
            'catalogId'   => $catalogId,
        ]);
    }
    
}
