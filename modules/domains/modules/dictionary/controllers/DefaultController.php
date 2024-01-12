<?php declare(strict_types = 1);

namespace modules\domains\modules\dictionary\controllers;

use Exception;
use modules\domains\Module as DomainsModule;
use modules\domains\modules\dictionary\models\DictionaryForm;
use modules\domains\modules\dictionary\models\DictionaryService;
use Throwable;
use Yii;
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
    public function actionIndex()
    {
        return $this->render('index', [
            'title' => DictionaryService::getTitle(),
            'grid'  => $this->getDictionaryGrid(),
        ]);
    }
    
    /**
     * Создание словаря
     *
     * @return string|Response
     * @throws Exception
     */
    public function actionCreate()
    {
        $model = $this->getDictionaryForm();
        
        if ($this->request->isPost
            && $model->load($this->request->post())
            && $model->save()
        ) {
            return $this->redirectIndex();
        }
        
        return $this->render('create', [
            'model'      => $model,
            'indexTitle' => DictionaryService::getTitle(),
        ]);
    }
    
    /**
     * Редактирование словаря
     *
     * @param int $dictionaryId
     *
     * @return string|Response
     * @throws Exception
     */
    public function actionUpdate(int $dictionaryId)
    {
        $model = $this->getDictionaryForm($dictionaryId);
        
        if ($this->request->isPost
            && $model->load($this->request->post())
            && $model->save()
        ) {
            return $this->redirectIndex();
        }
        
        return $this->render('update', [
            'model'      => $model,
            'indexTitle' => DictionaryService::getTitle(),
        ]);
    }
    
    /**
     * @return string
     * @throws Exception
     */
    private function getDictionaryGrid(): string
    {
        try {
            return Yii::$container->invoke(
                [
                    new DictionaryService,
                    'getGrid'
                ],
                [
                    'queryParams' => $this->request->queryParams,
                    'isEdit'      => DomainsModule::getInstance()->editDictionary(),
                ]
            );
        } catch (Throwable $e) {
            throw new Exception(sprintf(
                'Ошибка вызова DictionaryService->getGrid: %s',
                $e->getMessage()
            ));
        }
    }
    
    /**
     * @param int $dictionaryId
     *
     * @return DictionaryForm
     * @throws Exception
     */
    private function getDictionaryForm(int $dictionaryId = 0): DictionaryForm
    {
        try {
            return Yii::$container->invoke(
                [
                    new DictionaryService,
                    'getForm'
                ],
                [
                    'dictionaryId' => $dictionaryId
                ]
            );
        } catch (Throwable $e) {
            throw new Exception(sprintf(
                'Ошибка вызова DictionaryService->getForm: %s',
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
