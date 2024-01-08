<?php declare(strict_types = 1);

namespace modules\domains\modules\unit\controllers;

use modules\domains\Module as DomainsModule;
use modules\domains\modules\unit\models\UnitService;
use Exception;
use Throwable;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class DefaultController extends Controller
{
    
    /**
     * Список едениц измерения
     *
     * @return string
     * @throws Exception
     */
    public function actionIndex(): string
    {
        return $this->render('index', [
            'title' => UnitService::getTitle(),
            'grid'  => $this->getUnitGrid(),
        ]);
    }
    
    /**
     * Создание единицы измерения
     *
     * @return string|Response
     * @throws Exception
     */
    public function actionCreate()
    {
        $model = $this->getUnitForm();
        
        if ($this->request->isPost
            && $model->load($this->request->post())
            && $model->save()
        ) {
            return $this->redirectIndex();
        }
        
        return $this->render('create', [
            'model'      => $model,
            'indexTitle' => UnitService::getTitle(),
        ]);
    }
    
    /**
     * Редактирование единицы измерения
     *
     * @param int $unitId
     *
     * @return string|Response
     * @throws Exception
     */
    public function actionUpdate(int $unitId)
    {
        $model = $this->getUnitForm($unitId);
        
        if ($this->request->isPost
            && $model->load($this->request->post())
            && $model->save()
        ) {
            return $this->redirectIndex();
        }
        
        return $this->render('update', [
            'model'      => $model,
            'indexTitle' => UnitService::getTitle(),
        ]);
    }
    
    /**
     * @return mixed
     * @throws Exception
     */
    private function getUnitGrid(): mixed
    {
        try {
            return Yii::$container->invoke(
                [
                    new UnitService,
                    'getGrid',
                ],
                [
                    'queryParams' => $this->request->queryParams,
                    'isEdit'      => DomainsModule::getInstance()->editUnit(),
                ]
            );
        } catch (Throwable $e) {
            throw new Exception(sprintf(
                'Ошибка вызова UnitService->getGrid: %s',
                $e->getMessage()
            ));
        }
    }
    
    /**
     * @param int $unitId
     *
     * @return mixed
     * @throws Exception
     */
    private function getUnitForm(int $unitId = 0): mixed
    {
        try {
            return Yii::$container->invoke(
                [
                    new UnitService,
                    'getForm',
                ],
                [
                    'unitId' => $unitId,
                ]
            );
        } catch (Throwable $e) {
            throw new Exception(sprintf(
                'Ошибка вызова UnitService->getForm: %s',
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
