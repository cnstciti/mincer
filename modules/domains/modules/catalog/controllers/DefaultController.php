<?php declare(strict_types = 1);

namespace modules\domains\modules\catalog\controllers;

use Exception;
use modules\domains\Module as DomainsModule;
use modules\domains\modules\catalog\models\CatalogForm;
use modules\domains\modules\catalog\models\CatalogSearch;
use modules\domains\modules\catalog\models\CatalogService;
use yii\web\Controller;
use yii\web\Response;

class DefaultController extends Controller
{
    
    /**
     * Список каталогов
     *
     * @return string
     * @throws Exception
     * @throws \Throwable
     */
    public function actionIndex(): string
    {
        $service = new CatalogService();
        
        return $this->render('index', [
            'title' => $service->getTitle(),
            'grid'  => $service->getGrid(
                new CatalogSearch(),
                $this->request->queryParams,
                DomainsModule::getInstance()->editCatalog(),
            ),
        ]);
    }

    /**
     * Создание каталога
     *
     * @throws Exception
     */
    public function actionCreate()
    {
        $service = new CatalogService();
        $model = $service->getForm(new CatalogForm());

        if ($this->request->isPost
            && $model->load($this->request->post())
            && $model->save()
        ) {
            return $this->redirectIndex();
        }
        
        return $this->render('create', [
            'model'      => $model,
            'indexTitle' => $service->getTitle(),
            'parents'    => $service->dataForSelect2(),
        ]);
    }
    
    /**
     * Редактирование каталога
     *
     * @param int $catalogId
     *
     * @throws Exception
     */
    public function actionUpdate(int $catalogId)
    {
        $service = new CatalogService();
        $model = $service->getForm(new CatalogForm(), $catalogId);
        
        if ($this->request->isPost
            && $model->load($this->request->post())
            && $model->save()
        ) {
            return $this->redirectIndex();
        }
        
        return $this->render('update', [
            'model'      => $model,
            'indexTitle' => $service->getTitle(),
            'parents'    => $service->dataForSelect2(),
        ]);
    }
    
    /**
     * Редирект на список
     *
     * @return Response
     */
    private function redirectIndex(): Response
    {
        return $this->redirect(['index']);
    }
    
}
