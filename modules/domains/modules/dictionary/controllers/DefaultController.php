<?php declare(strict_types = 1);

namespace modules\domains\modules\dictionary\controllers;

use Exception;
use modules\domains\Module as DomainsModule;
use modules\domains\modules\dictionary\models\DictionaryForm;
use modules\domains\modules\dictionary\models\DictionarySearch;
use modules\domains\modules\dictionary\models\DictionaryService;
use yii\web\Controller;
use yii\web\Response;

class DefaultController extends Controller
{
    
    /**
     * Список словарей
     *
     * @return string
     * @throws Exception
     */
    public function actionIndex(): string
    {
        $service = new DictionaryService();
        
        return $this->render('index', [
            'title' => $service->getTitle(),
            'grid'  => $service->getGrid(
                new DictionarySearch(),
                $this->request->queryParams,
                DomainsModule::getInstance()->editDictionary()
            ),
        ]);
    }

    /**
     * Создание словаря
     *
     * @throws Exception
     */
    public function actionCreate()
    {
        $service = new DictionaryService();
        $model = $service->getForm(new DictionaryForm());
        
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
     * Редактирование словаря
     *
     * @param int $dictionaryId
     *
     * @throws Exception
     */
    public function actionUpdate(int $dictionaryId)
    {
        $service = new DictionaryService();
        $model = $service->getForm(new DictionaryForm(), $dictionaryId);
        
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
