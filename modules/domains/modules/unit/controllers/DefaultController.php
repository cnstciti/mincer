<?php declare(strict_types = 1);

namespace modules\domains\modules\unit\controllers;

use modules\domains\Module as DomainsModule;
use modules\domains\modules\unit\models\UnitForm;
use modules\domains\modules\unit\models\UnitSearch;
use modules\domains\modules\unit\models\UnitService;
use Exception;
use yii\web\Controller;
use yii\web\Response;

class DefaultController extends Controller
{
    
    /**
     * Список единиц измерения
     *
     * @return string
     * @throws Exception
     */
    public function actionIndex(): string
    {
        $service = new UnitService();
        
        return $this->render('index', [
            'title' => $service->getTitle(),
            'grid'  => $service->getGrid(
                searchModel: new UnitSearch(),
                queryParams: $this->request->queryParams,
                isEdit:      DomainsModule::getInstance()->editUnit(),
            ),
        ]);
    }
    
    /**
     * Создание единицы измерения
     *
     * @return string|Response
     * @throws Exception
     */
    public function actionCreate(): string|Response
    {
        $service = new UnitService();
        $model   = $service->getForm(new UnitForm());
        
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
     * Редактирование единицы измерения
     *
     * @param int $unitId
     *
     * @return string|Response
     * @throws Exception
     */
    public function actionUpdate(int $unitId): string|Response
    {
        $service = new UnitService();
        $model   = $service->getForm(new UnitForm(), $unitId);
        
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
