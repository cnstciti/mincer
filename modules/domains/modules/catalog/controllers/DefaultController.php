<?php declare(strict_types = 1);

namespace modules\domains\modules\catalog\controllers;

use Exception;
use modules\domains\Module as DomainsModule;
use modules\domains\modules\catalog\models\CatalogForm;
use modules\domains\modules\catalog\models\CatalogService;
use Throwable;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class DefaultController extends Controller
{
    
    /**
     * Список каталогов
     *
     * @return string
     * @throws Exception
     */
    public function actionIndex(): string
    {
        return $this->render('index', [
            'title' => CatalogService::getTitle(),
            'grid'  => $this->getCatalogGrid(),
        ]);
    }
    
    /**
     * Создание каталога
     *
     * @return string|Response
     * @throws Exception
     */
    public function actionCreate()
    {
        $model = $this->getCatalogForm();
        
        if ($this->request->isPost
            && $model->load($this->request->post())
            && $model->save()
        ) {
            return $this->redirectIndex();
        }
        
        return $this->render('create', [
            'model'      => $model,
            'indexTitle' => CatalogService::getTitle(),
            'parents'    => CatalogService::dataForSelect2(),
        ]);
    }
    
    /**
     * Редактирование каталога
     *
     * @param int $catalogId
     *
     * @return string|Response
     * @throws Exception
     */
    public function actionUpdate(int $catalogId)
    {
        $model = $this->getCatalogForm($catalogId);
        
        if ($this->request->isPost
            && $model->load($this->request->post())
            && $model->save()
        ) {
            return $this->redirectIndex();
        }
        
        return $this->render('update', [
            'model'      => $model,
            'indexTitle' => CatalogService::getTitle(),
            'parents'    => CatalogService::dataForSelect2(),
        ]);
    }
    
    /**
     * @return string
     * @throws Exception
     */
    private function getCatalogGrid(): string
    {
        try {
            return Yii::$container->invoke(
                [
                    new CatalogService,
                    'getGrid'
                ],
                [
                    'queryParams' => $this->request->queryParams,
                    'isEdit'      => DomainsModule::getInstance()->editCatalog(),
                ]
            );
        } catch (Throwable $e) {
            throw new Exception(sprintf(
                'Ошибка вызова CatalogService->getGrid: %s',
                $e->getMessage()
            ));
        }
    }
    
    /**
     * @param int $catalogId
     *
     * @return CatalogForm
     * @throws Exception
     */
    private function getCatalogForm(int $catalogId = 0): CatalogForm
    {
        try {
            return Yii::$container->invoke(
                [
                    new CatalogService,
                    'getForm'
                ],
                [
                    'catalogId' => $catalogId
                ]
            );
        } catch (Throwable $e) {
            throw new Exception(sprintf(
                'Ошибка вызова CatalogService->getForm: %s',
                $e->getMessage()
            ));
        }
    }
    
    /**
     * @return Response
     */
    private function redirectIndex(): Response
    {
        return $this->redirect(['index']);
    }
    
}
