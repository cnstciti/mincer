<?php declare(strict_types = 1);

namespace modules\domains\modules\type_value\controllers;

use Exception;
use modules\domains\Module as DomainsModule;
use modules\domains\modules\type_value\models\TypeValueForm;
use modules\domains\modules\type_value\models\TypeValueService;
use Throwable;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class DefaultController extends Controller
{
    
    /**
     * Список типов значений
     *
     * @return string
     * @throws Exception
     */
    public function actionIndex(): string
    {
        return $this->render('index', [
            'title' => TypeValueService::getTitle(),
            'grid'  => $this->getTypeValueGrid(),
        ]);
    }
    
    /**
     * Создание типа значения
     *
     * @return string|Response
     * @throws Exception
     */
    public function actionCreate()
    {
        $model = $this->getTypeValueForm();
        
        if ($this->request->isPost
            && $model->load($this->request->post())
            && $model->save()
        ) {
            return $this->redirectIndex();
        }
        
        return $this->render('create', [
            'model'      => $model,
            'indexTitle' => TypeValueService::getTitle(),
        ]);
    }
    
    /**
     * Редактирование типа значения
     *
     * @param int $typeValueId
     *
     * @return string|Response
     * @throws Exception
     */
    public function actionUpdate(int $typeValueId)
    {
        $model = $this->getTypeValueForm($typeValueId);
        
        if ($this->request->isPost
            && $model->load($this->request->post())
            && $model->save()
        ) {
            return $this->redirectIndex();
        }
        
        return $this->render('update', [
            'model'      => $model,
            'indexTitle' => TypeValueService::getTitle(),
        ]);
    }
    
    /**
     * @return string
     * @throws Exception
     */
    private function getTypeValueGrid(): string
    {
        try {
            return Yii::$container->invoke(
                [
                    new TypeValueService,
                    'getGrid',
                ],
                [
                    'queryParams' => $this->request->queryParams,
                    'isEdit'      => DomainsModule::getInstance()->editTypeValue(),
                ]
            );
        } catch (Throwable $e) {
            throw new Exception(sprintf(
                'Ошибка вызова TypeValueService->getGrid: %s',
                $e->getMessage()
            ));
        }
    }
    
    /**
     * @param int $typeValueId
     *
     * @return TypeValueForm
     * @throws Exception
     */
    private function getTypeValueForm(int $typeValueId = 0): TypeValueForm
    {
        try {
            return Yii::$container->invoke(
                [
                    new TypeValueService,
                    'getForm',
                ],
                [
                    'typeValueId' => $typeValueId,
                ]
            );
        } catch (Throwable $e) {
            throw new Exception(sprintf(
                'Ошибка вызова TypeValueService->getForm: %s',
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
