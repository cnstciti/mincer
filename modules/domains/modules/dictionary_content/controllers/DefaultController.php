<?php declare(strict_types = 1);

namespace modules\domains\modules\dictionary_content\controllers;

use Exception;
use modules\domains\Module as DomainsModule;
use modules\domains\modules\dictionary\models\DictionaryService;
use modules\domains\modules\dictionary_content\models\DictionaryContentForm;
use modules\domains\modules\dictionary_content\models\DictionaryContentService;
use modules\domains\modules\dictionary_content\models\DictionaryContentSearch;
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
     * @throws \Throwable
     */
    public function actionIndex(int $dictionaryId): string
    {
        $serviceDic = new DictionaryService();
        $serviceDicCont = new DictionaryContentService();

        $title = sprintf(
            '%s. %s',
            $serviceDic->getName($dictionaryId),
            $serviceDicCont->getTitle()
        );
        
        return $this->render('index', [
            'title' => $title,
            'grid'  => $serviceDicCont->getGrid(
                new DictionaryContentSearch(),
                $this->request->queryParams,
                DomainsModule::getInstance()->editDictionaryContent(),
                $title,
            ),
        ]);
    }

    /**
     * Создание содержания словаря
     *
     * @param int $dictionaryId
     *
     * @throws Exception
     */
    public function actionCreate(int $dictionaryId)
    {
        $serviceDic = new DictionaryService();
        $serviceDicCont = new DictionaryContentService();

        $model = $serviceDicCont->getForm(new DictionaryContentForm());
        $model->dictionaryId = $dictionaryId;

        if ($this->request->isPost
            && $model->load($this->request->post())
            && $model->save()
        ) {
            return $this->redirectIndex($dictionaryId);
        }
        
        return $this->render('create', [
            'model'          => $model,
            'dictionaryName' => $serviceDic->getName($dictionaryId),
        ]);
    }
    
    /**
     * Редактирование содержания словаря
     *
     * @param int $dictionaryContentId
     * @param int $dictionaryId
     *
     * @throws Exception
     */
    public function actionUpdate(int $dictionaryId, int $dictionaryContentId)
    {
        $serviceDic = new DictionaryService();
        $serviceDicCont = new DictionaryContentService();
    
        $model = $serviceDicCont->getForm(new DictionaryContentForm(), $dictionaryContentId);
        
        if ($this->request->isPost
            && $model->load($this->request->post())
            && $model->save()
        ) {
            return $this->redirectIndex($dictionaryId);
        }
        
        return $this->render('update', [
            'model'          => $model,
            'dictionaryName' => $serviceDic->getName($dictionaryId),
        ]);
    }

    /**
     * Редирект на список
     *
     * @return Response
     */
    private function redirectIndex(int $dictionaryId): Response
    {
        return $this->redirect(['index', 'dictionaryId' => $dictionaryId]);
    }
    
}
