<?php declare(strict_types = 1);

namespace modules\domains\modules\attribute\controllers;

use Exception;
use modules\domains\Module as DomainsModule;
use modules\domains\modules\attribute\models\AttributeForm;
use modules\domains\modules\attribute\models\AttributeSearch;
use modules\domains\modules\attribute\models\AttributeSelectForm;
use modules\domains\modules\attribute\models\AttributeService;
use modules\domains\modules\catalog_attribute\models\CatalogAttributeService;
use modules\domains\modules\catalog\models\CatalogService;
use modules\domains\modules\dictionary\models\DictionaryService;
use modules\domains\modules\type_value\models\TypeValueService;
use modules\domains\modules\unit\models\UnitService;
use Throwable;
use yii\web\Controller;
use yii\web\Response;

class DefaultController extends Controller
{
    
    /**
     * Список атрибутов
     *
     * @param int $catalogId
     *
     * @return string
     * @throws Exception
     * @throws Throwable
     */
    public function actionIndex(int $catalogId): string
    {
        $service = new AttributeService();
        $title = $this->getCatalogAttributeTitle($catalogId);
        
        return $this->render('index', [
            'title' => $title,
            'grid'  => $service->getGrid(
                new AttributeSearch(),
                $this->request->queryParams,
                DomainsModule::getInstance()->editAttribute(),
                $title,
            ),
        ]);
    }
    
    /**
     * Создание атрибута
     *
     * @param int $catalogId
     *
     * @throws Throwable
     */
    public function actionCreate(int $catalogId)
    {
        $service = new AttributeService();
        $model = $service->getForm(new AttributeForm());

        if ($this->request->isPost
            && $model->load($this->request->post())
        ) {
            $transaction = DomainsModule::getInstance()->beginTransaction();
            try {
                $model->save();

                (new CatalogAttributeService())
                    ->insert($catalogId, $service->lastId());

                $transaction->commit();
            } catch (Throwable $e) {
                $transaction->rollBack();
                throw $e;
            }

            return $this->redirectIndex($catalogId);
        }
        
        return $this->render('create', [
            'attributeModel'     => $model,
            'title'              => $this->getCatalogAttributeTitle($catalogId),
            'catalogId'          => $catalogId,
            'units'              => (new UnitService())->dataForSelect2(),
            'dictionaries'       => (new DictionaryService())->dataForSelect2(),
            'types'              => (new TypeValueService())->dataForSelect2(),
        ]);
    }
    
    /**
     * Редактирование атрибута
     *
     * @param int $attributeId
     * @param int $catalogId
     *
     * @throws Exception
     */
    public function actionUpdate(int $attributeId, int $catalogId)
    {
        $service = new AttributeService();
        $model = $service->getForm(new AttributeForm(), $attributeId);
        
        if ($this->request->isPost
            && $model->load($this->request->post())
            && $model->save()
        ) {
            return $this->redirectIndex($catalogId);
        }

        return $this->render('update', [
            'attributeModel'     => $model,
            'title'              => $this->getCatalogAttributeTitle($catalogId),
            'catalogId'          => $catalogId,
            'units'              => (new UnitService())->dataForSelect2(),
            'dictionaries'       => (new DictionaryService())->dataForSelect2(),
            'types'              => (new TypeValueService())->dataForSelect2(),
        ]);
    }
    
    /**
     * Выбор существующего арибута
     *
     * @param int $catalogId
     *
     * @throws Exception
     */
    public function actionSelect(int $catalogId)
    {
        $service = new AttributeService();
        $model = new AttributeSelectForm();
        
        if ($this->request->isPost
            && $model->load($this->request->post())
        ) {
            (new CatalogAttributeService())
                ->insert($catalogId, (int)$model->attributeId);
    
            return $this->redirectIndex($catalogId);
        }
        
        return $this->render('select', [
            'model'      => $model,
            'title'      => $this->getCatalogAttributeTitle($catalogId),
            'catalogId'  => $catalogId,
            'attributes' => $service->dataForSelect2($catalogId),
        ]);
    }
    
    /**
     * Заголовок 'Каталог. Атрибут'
     *
     * @param int $catalogId
     * @return string
     */
    private function getCatalogAttributeTitle(int $catalogId): string
    {
        return sprintf(
            '%s. %s',
            (new CatalogService())->getName($catalogId),
            (new AttributeService())->getTitle()
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
    
}
