<?php declare(strict_types = 1);

namespace modules\domains\modules\type_value\controllers;

use Exception;
use modules\domains\Module as DomainsModule;
use modules\domains\modules\type_value\models\TypeValueForm;
use modules\domains\modules\type_value\models\TypeValueService;
use modules\domains\modules\type_value\models\TypeValueSearch;
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
        $service = new TypeValueService();
    
        return $this->render('index', [
            'title' => $service->getTitle(),
            'grid'  => $service->getGrid(
                new TypeValueSearch(),
                $this->request->queryParams,
                DomainsModule::getInstance()->editTypeValue(),
            ),
        ]);
    }

    /**
     * Создание типа значения
     *
     * @throws Exception
     */
    public function actionCreate()
    {
        $service = new TypeValueService();
        $model = $service->getForm(new TypeValueForm());
        
        if ($this->request->isPost
            && $model->load($this->request->post())
            && $model->save()
        ) {
            return $this->redirectIndex();
        }
        
        return $this->render('create', [
            'model'      => $model,
            'indexTitle' => $service->getTitle(),
        ]);
    }
    
    /**
     * Редактирование типа значения
     *
     * @param int $typeValueId
     *
     * @throws Exception
     */
    public function actionUpdate(int $typeValueId)
    {
        $service = new TypeValueService();
        $model = $service->getForm(new TypeValueForm(), $typeValueId);
        
        if ($this->request->isPost
            && $model->load($this->request->post())
            && $model->save()
        ) {
            return $this->redirectIndex();
        }
        
        return $this->render('update', [
            'model'      => $model,
            'indexTitle' => $service->getTitle(),
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
