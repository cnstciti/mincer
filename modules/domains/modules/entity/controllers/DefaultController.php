<?php declare(strict_types = 1);

namespace modules\domains\modules\entity\controllers;

use Exception;
use modules\domains\Module as DomainsModule;
use modules\domains\modules\catalog\models\CatalogService;
use modules\domains\modules\entity\models\CatalogEntityService;
use modules\domains\modules\entity\models\EntityService;
use Throwable;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class DefaultController extends Controller
{
    
    /**
     * Список продуктов
     *
     * @param int $catalogId
     *
     * @return string
     * @throws Exception
     */
    public function actionIndex(int $catalogId): string
    {
        $title = self::getCatalogEntityTitle($catalogId);
        
        return $this->render('index', [
            'title' => $title,
            'grid'  => $this->getGrid(
                $this->request->queryParams,
                $title
            ),
        ]);
    }
    
    /**
     * Создание продукта
     *
     * @param int $catalogId
     *
     * @return string|Response
     * @throws Exception
     */
    public function actionCreate(int $catalogId)
    {
        $model = $this->getForm();
        //$model->catalogId = $catalogId;
        
        if ($this->request->isPost
            && $model->load($this->request->post())
        ) {
            $transaction = DomainsModule::getInstance()->beginTransaction();
            try {
                $model->save();

                CatalogEntityService::insert($catalogId, EntityService::lastId());

                $transaction->commit();
            } catch (Throwable $e) {
                $transaction->rollBack();
                throw $e;
            }

            return $this->redirectIndex($catalogId);
        }
        
        return $this->render('create', [
            'model'     => $model,
            'title'     => self::getCatalogEntityTitle($catalogId),
            'catalogId' => $catalogId,
        ]);
    }
    
    /**
     * Редактирование продукта
     *
     * @param int $entityId
     * @param int $catalogId
     *
     * @return string|Response
     * @throws Exception
     */
    public function actionUpdate(int $entityId, int $catalogId)
    {
        $model = $this->getForm($entityId);
        
        if ($this->request->isPost
            && $model->load($this->request->post())
            && $model->save()
        ) {
            return $this->redirectIndex($catalogId);
        }
        
        return $this->render('update', [
            'model'     => $model,
            'title'     => self::getCatalogEntityTitle($catalogId),
            'catalogId' => $catalogId,
        ]);
    }

    /**
     * @param array  $queryParamsdw
     * @param string $title
     *
     * @return mixed
     * @throws Exception
     */
    private function getGrid(
        array $queryParams,
        string $title
    ): mixed {
        try {
            return Yii::$container->invoke(
                [
                    new EntityService,
                    'getGrid',
                ],
                [
                    'queryParams' => $queryParams,
                    'title'       => $title,
                ]
            );
        } catch (Throwable $e) {
            throw new Exception(sprintf(
                'Ошибка вызова EntityService->getGrid: %s',
                $e->getMessage()
            ));
        }
    }

    /**
     * @param int $entityId
     *
     * @return mixed
     * @throws Exception
     */
    private function getForm(int $entityId = 0): mixed
    {
        try {
            return Yii::$container->invoke(
                [
                    new EntityService,
                    'getForm',
                ],
                [
                    'entityId' => $entityId,
                ]
            );
        } catch (Throwable $e) {
            throw new Exception(sprintf(
                'Ошибка вызова EntityService->getForm: %s',
                $e->getMessage()
            ));
        }
    }
    
    /**
     * @param int $catalogId
     *
     * @return string
     */
    private static function getCatalogEntityTitle(int $catalogId): string
    {
        return sprintf(
            '%s. %s',
            CatalogService::getName($catalogId),
            EntityService::getTitle()
        );
    }
    
    /**
     * @param int $catalogId
     *
     * @return Response
     */
    private function redirectIndex(int $catalogId): Response
    {
        return $this->redirect(['index', 'catalogId' => $catalogId]);
    }
    
}
