<?php declare(strict_types = 1);

namespace modules\domains\modules\dictionary_content\controllers;

use Exception;
use modules\domains\Module as DomainsModule;
use modules\domains\modules\dictionary\models\DictionaryService;
use modules\domains\modules\dictionary_content\models\DictionaryContentForm;
use modules\domains\modules\dictionary_content\models\DictionaryContentService;
use RuntimeException;
use Throwable;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class DefaultController extends Controller
{
    
    /**
     * Список содержаний словаря
     *
     * @param int $dictionaryId
     *
     * @return string
     * @throws Exception
     */
    public function actionIndex(int $dictionaryId): string
    {
        $title = sprintf(
            '%s. %s',
            DictionaryService::getName($dictionaryId),
            DictionaryContentService::getTitle()
        );
        
        return $this->render('index', [
            'title' => $title,
            'grid'  => $this->getDictionaryContentGrid($title),
        ]);
    }
    
    /**
     * Создание содержания словаря
     *
     * @param int $dictionaryId
     *
     * @return string|Response
     * @throws Exception
     */
    public function actionCreate(int $dictionaryId)
    {
        $model = $this->getDictionaryContentForm();
        $model->dictionaryId = $dictionaryId;
        
        if ($this->request->isPost
            && $model->load($this->request->post())
            && $model->save()
        ) {
            return $this->redirectIndex($dictionaryId);
        }
        
        return $this->render('create', [
            'model'          => $model,
            'dictionaryName' => DictionaryService::getName($dictionaryId),
        ]);
    }
    
    /**
     * Редактирование содержания словаря
     *
     * @param int $dictionaryContentId
     * @param int $dictionaryId
     *
     * @return string|Response
     * @throws Exception
     */
    public function actionUpdate(int $dictionaryContentId, int $dictionaryId)
    {
        $model = $this->getDictionaryContentForm($dictionaryContentId);
        
        if ($this->request->isPost
            && $model->load($this->request->post())
            && $model->save()
        ) {
            return $this->redirectIndex($dictionaryId);
        }
        
        return $this->render('update', [
            'model'          => $model,
            'dictionaryName' => DictionaryService::getName($dictionaryId),
        ]);
    }
    
    /**
     * @param string $title
     * @param int    $dictionaryId
     *
     * @return string
     * @throws Exception
     */
    private function getDictionaryContentGrid(string $title): string
    {
        try {
            return Yii::$container->invoke(
                [
                    new DictionaryContentService,
                    'getGrid',
                ],
                [
                    'queryParams'  => $this->request->queryParams,
                    'isEdit'       => DomainsModule::getInstance()->editDictionaryContent(),
                    'title'        => $title,
                ]
            );
        } catch (Throwable $e) {
            throw new Exception(sprintf(
                'Ошибка вызова DictionaryContentService->getGrid: %s',
                $e->getMessage()
            ));
        }
    }
    
    /**
     * @param int $dictionaryContentId
     *
     * @return DictionaryContentForm
     * @throws Exception
     */
    private function getDictionaryContentForm(int $dictionaryContentId = 0): DictionaryContentForm
    {
        try {
            return Yii::$container->invoke(
                [
                    new DictionaryContentService,
                    'getForm'
                ],
                [
                    'dictionaryContentId' => $dictionaryContentId
                ]
            );
        } catch (Throwable $e) {
            throw new Exception(sprintf(
                'Ошибка вызова DictionaryContentService->getForm: %s',
                $e->getMessage()
            ));
        }
    }
    
    /**
     * @return Response
     */
    private function redirectIndex(int $dictionaryId): Response
    {
        return $this->redirect(['index', 'dictionaryId' => $dictionaryId]);
    }
    
}
