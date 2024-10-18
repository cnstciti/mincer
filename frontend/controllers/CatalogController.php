<?php declare(strict_types = 1);

namespace frontend\controllers;

use common\models\services\CatalogService;
use Exception;
use Throwable;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class CatalogController extends Controller
{
    
    /**
     * Список каталогов
     * @throws Throwable
     */
    public function actionIndex()
    {
        $service = new CatalogService();
        
        $title = $service->title();
        $grid  = $service->grid(
            $this->request->queryParams,
            Yii::$app->params['domain.edit.catalog']
        );
        
        return $this->render('index', [
            'title' => $title,
            'grid'  => $grid,
        ]);
    }
    
    /**
     * Создание каталога
     * @throws Exception
     */
    public function actionCreate()
    {
        $service = new CatalogService();
        
        $model      = $service->form();
        $indexTitle = $service->title();
        $parents    = $service->mapIdName();
        
        if ($this->request->isPost
            && $model->load($this->request->post())
            && $model->save()
        ) {
            return $this->redirectIndex();
        }
        
        return $this->render('create', [
            'model'      => $model,
            'indexTitle' => $indexTitle,
            'parents'    => $parents,
        ]);
    }
    
    /**
     * Редактирование каталога
     * @param int $catalogId
     * @throws Exception
     */
    public function actionUpdate(int $catalogId)
    {
        $service = new CatalogService();
        
        $model      = $service->form($catalogId);
        $indexTitle = $service->title();
        $parents    = $service->mapIdName();
        
        if ($this->request->isPost
            && $model->load($this->request->post())
            && $model->save()
        ) {
            return $this->redirectIndex();
        }
        
        return $this->render('update', [
            'model'      => $model,
            'indexTitle' => $indexTitle,
            'parents'    => $parents,
        ]);
    }
    
    /**
     * Редирект на список
     * @return Response
     */
    private function redirectIndex(): Response
    {
        return $this->redirect(['index']);
    }
    
}
