<?php declare(strict_types = 1);

namespace modules\domains\modules\entity\controllers;

use Exception;
use modules\domains\Module as DomainsModule;
use modules\domains\modules\catalog\models\CatalogService;
use modules\domains\modules\catalog_entity\models\CatalogEntityService;
use modules\domains\modules\entity\models\EntityForm;
use modules\domains\modules\entity\models\EntitySearch;
use modules\domains\modules\entity\models\EntityService;
//use modules\domains\modules\value\models\ValueImageService;
//use modules\domains\modules\value\models\ValueService;
use Throwable;
use yii\web\Controller;
use yii\web\Response;

class DefaultController extends Controller
{
    
    /**
     * Список продуктов
     *
     * @param int $catalogId
     * @return string
     * @throws Exception
     * @throws Throwable
     */
    public function actionIndex(int $catalogId): string
    {
        $service = new EntityService();
        $title = $this->getCatalogEntityTitle($catalogId);
        
        return $this->render('index', [
            'title' => $title,
            'grid'  => $service->getGrid(
                new EntitySearch(),
                $this->request->queryParams,
                $title,
            ),
        ]);
    }

    /**
     * Создание продукта
     *
     * @param int $catalogId
     * @throws Exception
     * @throws Throwable
     */
    public function actionCreate(int $catalogId)
    {
        $service = new EntityService();
        $model = $service->getForm(new EntityForm());

        if ($this->request->isPost
            && $model->load($this->request->post())
        ) {
            $transaction = DomainsModule::getInstance()->beginTransaction();
            try {
                $model->save();

                (new CatalogEntityService)->insert($catalogId, $service->lastId());

                $transaction->commit();
            } catch (Throwable $e) {
                $transaction->rollBack();
                throw $e;
            }

            return $this->redirectIndex($catalogId);
        }
        
        return $this->render('create', [
            'model'     => $model,
            'title'     => $this->getCatalogEntityTitle($catalogId),
            'catalogId' => $catalogId,
        ]);
    }
    
    /**
     * Редактирование продукта
     *
     * @param int $entityId
     * @param int $catalogId
     * @throws Exception
     */
    public function actionUpdate(int $entityId, int $catalogId)
    {
        $service = new EntityService();
        $model = $service->getForm(new EntityForm(), $entityId);
        
        if ($this->request->isPost
            && $model->load($this->request->post())
            && $model->save()
        ) {
            return $this->redirectIndex($catalogId);
        }
        
        return $this->render('update', [
            'model'     => $model,
            'title'     => $this->getCatalogEntityTitle($catalogId),
            'catalogId' => $catalogId,
        ]);
    }
    
    /**
     * Заголовок 'Каталог. Продукт'
     *
     * @param int $catalogId
     * @return string
     */
    private function getCatalogEntityTitle(int $catalogId): string
    {
        return sprintf(
            '%s. %s',
            (new CatalogService())->getName($catalogId),
            (new EntityService())->getTitle()
        );
    }
    
    /**
     * Редирект на список
     *
     * @param int $catalogId
     * @return Response
     */
    private function redirectIndex(int $catalogId): Response
    {
        return $this->redirect(['index', 'catalogId' => $catalogId]);
    }
/*
    public function actionDemo(int $entityId, int $catalogId)
    {
        $valueService = new ValueService();
        
        return $this->render('demo', [
            'catalogName' => (new CatalogService)->getName($catalogId),
            'entityName' => (new EntityService)->getName($entityId),
            'catalogId' => $catalogId,
            'pictures' => (new ValueImageService)->getForDemo($entityId, $catalogId),
            'simpleTypes' => $valueService->getSimpleTypeForDemo($entityId, $catalogId),
            'setTypes' => $valueService->getSetTypeForDemo($entityId, $catalogId),
        ]);
    }
    */
}
