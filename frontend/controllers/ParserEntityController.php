<?php

namespace frontend\controllers;

use Exception;
use frontend\models\parser_entity\ParserEntityService;
use modules\domains\modules\catalog\models\CatalogService;
use modules\domains\modules\catalog_entity\models\CatalogEntityService;
use modules\domains\modules\entity\models\EntityService;
use Throwable;
use Yii;
use yii\web\Controller;

class ParserEntityController extends Controller
{
    
    /**
     * @throws \Throwable
     */
    public function actionIndex()
    {
        $service = new ParserEntityService();
        
        $title = $service->title();
        $grid  = $service->getGrid(
            $this->request->queryParams,
            $title,
            );
        
        return $this->render('index', [
            'title' => $title,
            'grid'  => $grid,
        ]);
    }
    
    /**
     * Привязать товар к каталогу
     * @param int $entityId
     * @throws Exception
     */
    public function actionLinkCatalog(int $id)
    {
        $service = new ParserEntityService();
        
        $model      = $service->getLinkCatalogForm($id);
        $indexTitle = $service->title();
        $catalogs   = (new CatalogService)->mapContainsProductsOnly();
        
        if ($this->request->isPost
            //&& $model->validate()
            && $model->load($this->request->post())
            && $model->save()
        ) {
            return $this->redirect(['index']);
        }
        
        return $this->render('link-catalog', [
            'model'      => $model,
            'indexTitle' => $indexTitle,
            'catalogs'   => $catalogs,
        ]);
    }
    
    /**
     * Привязать товар к базовому товару из Entity
     * Или сделать товар базовым
     * @param int $id
     * @param int $catalogId
     * @param int $entityId
     * @throws Throwable
     */
    public function actionLinkEntity(int $id, int $catalogId, int $entityId)
    {
        $service = new ParserEntityService();

        $model      = $service->getLinkEntityForm($id);
        $indexTitle = $service->title();
        $name       = $service->name($id);
        $entities   = $service->products($catalogId, $entityId);
        
        if ($this->request->isPost
            && $model->validate()
            && $model->load($this->request->post())
        ) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                if (intval($model->isBaseEntity)) {
                    $entityService = new EntityService();
                    // текущий продукт делаем базовым
                    $entityService->create($name);
                    $model->entityId = $entityService->lastId();
                    (new CatalogEntityService)->insert($catalogId, $model->entityId);
                }
                $model->save();
        
                $transaction->commit();
            } catch (Throwable $e) {
                $transaction->rollBack();
                throw $e;
            }
            
            return $this->redirect(['index']);
        }
        
        return $this->render('link-entity', [
            'model'      => $model,
            'indexTitle' => $indexTitle,
            'name'       => $name,
            'entities'   => $entities,
        ]);
    }
    
}
