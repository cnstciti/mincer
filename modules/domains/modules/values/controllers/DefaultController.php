<?php declare(strict_types = 1);

namespace modules\domains\modules\values\controllers;

use Exception;
use modules\domains\modules\catalog\models\CatalogService;
use modules\domains\modules\dictionary_content\models\DictionaryContentService;
use modules\domains\modules\entity\models\ParserEntityService;
use modules\domains\modules\image_type\models\ImageTypeSearch;
use modules\domains\modules\image_type\models\ImageTypeService;
use modules\domains\modules\set_type\models\SetTypeSearch;
use modules\domains\modules\set_type\models\SetTypeService;
use modules\domains\modules\simple_type\models\SimpleTypeSearch;
use modules\domains\modules\simple_type\models\SimpleTypeSelectForm;
use modules\domains\modules\simple_type\models\SimpleTypeService;
use modules\domains\modules\value_image\models\ValueImageService;
use modules\domains\modules\value_set\models\ValueSetService;
use modules\domains\modules\values\models\ValuesService;
use Throwable;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\UploadedFile;

class DefaultController extends Controller
{
    
    /**
     * Список значений
     *
     * @param int $catalogId
     * @param int $entityId
     * @return string
     * @throws Exception
     * @throws Throwable
     */
    public function actionIndex(int $catalogId, int $entityId): string
    {
        $title = $this->getEntityValueTitle($entityId);

        return $this->render('index', [
            'title'          => $title . '. Значения',
            'simpleTypeGrid' => (new SimpleTypeService)->getGrid(
                new SimpleTypeSearch(),
                $this->request->queryParams,
                $title . '. Простые типы',
                $entityId,
                $catalogId
            ),
            'setTypeGrid'    => (new SetTypeService)->getGrid(
                new SetTypeSearch(),
                $this->request->queryParams,
                $title . '. Списочные типы'
            ),
            'imgTypeGrid'    => (new ImageTypeService)->getGrid(
                new ImageTypeSearch(),
                $this->request->queryParams,
                $title . '. Изображения'
            ),
            'catalogId'      => $catalogId,
            'indexTitle'     => $this->getCatalogEntityTitle($catalogId),
        ]);
    }

    /**
     * Редактирование значения простого типа
     *
     * @param string $typeName
     * @param string $attributeName
     * @param int    $catalogId
     * @param int    $entityId
     * @param int    $valueId
     * @param int    $dictionaryId
     * @param int    $catalogAttributeId
     * @param int    $catalogEntityId
     * @param int    $typeId
     * @return string
     * @throws Exception
     */
    public function actionSimpleTypeUpdate(
        string $typeName,
        string $attributeName,
        int $catalogId,
        int $entityId,
        int $valueId,
        int $dictionaryId,
        int $catalogAttributeId,
        int $catalogEntityId,
        int $typeId
    ): string
    {
        $service = new ValuesService();
        $model = $service->getModelByType($typeName, $valueId);
    
        if ($this->request->isPost
            && $model->load($this->request->post())
        ) {
            $service->update(
                $model,
                $catalogAttributeId,
                $catalogEntityId,
                $typeId
            );

            $this->redirect(['index', 'entityId' => $entityId, 'catalogId' => $catalogId]);
        }

        return $this->render('simple-type-update', [
            'model'         => $model,
            'title'         => $this->getEntityValueTitle($entityId) . '. Значения',
            'indexTitle'    => $this->getCatalogEntityTitle($catalogId),
            'catalogId'     => $catalogId,
            'entityId'      => $entityId,
            'typeName'      => $typeName,
            'attributeName' => $attributeName,
            'dictionaries'  => (new DictionaryContentService())->dataForSelect2($dictionaryId),
        ]);
    }
    
    /**
     * Редактирование значения списочного типа
     *
     * @param string $attributeName
     * @param int    $entityId
     * @param int    $catalogId
     * @param int    $dictionaryId
     * @param int    $catalogAttributeId
     * @param int    $catalogEntityId
     * @param int    $typeId
     * @return string
     * @throws Exception
     */
    public function actionSetTypeUpdate(
        string $attributeName,
        int $entityId,
        int $catalogId,
        int $dictionaryId,
        int $catalogAttributeId,
        int $catalogEntityId,
        int $typeId
    ): string
    {
        $service = new ValueSetService;
        $model = $service->getModel($catalogAttributeId, $catalogEntityId);
        
        if ($this->request->isPost
            && $model->load($this->request->post())
        ) {
            $service->update(
                $model,
                $catalogAttributeId,
                $catalogEntityId,
                $typeId
            );

            $this->redirect(['index', 'entityId' => $entityId, 'catalogId' => $catalogId]);
        }
    
        return $this->render('set-type-update', [
            'model'         => $model,
            'title'         => $this->getEntityValueTitle($entityId) . '. Значения',
            'indexTitle'    => $this->getCatalogEntityTitle($catalogId),
            'catalogId'     => $catalogId,
            'entityId'      => $entityId,
            'attributeName' => $attributeName,
            'dictionaries'  => (new DictionaryContentService())->dataForSelect2($dictionaryId),
        ]);
    }
    
    /**
     * @param int $entityId
     * @param int $catalogId
     * @param int $catalogAttributeId
     * @param int $catalogEntityId
     * @param int $typeId
     * @return string
     * @throws Exception
     */
    public function actionLoadImg(
        int $entityId,
        int $catalogId,
        int $catalogAttributeId,
        int $catalogEntityId,
        int $typeId
    ): string
    {
        $service = new ValueImageService;
        $model = $service->getModel();
        
        if ($this->request->isPost
            && $model->load($this->request->post())
            && !empty($file = UploadedFile::getInstance($model, 'file'))
        ) {
            (new ImageTypeService)->load(
                $file,
                $catalogAttributeId,
                $catalogEntityId,
                $typeId
            );

            $this->redirect(['index', 'entityId' => $entityId, 'catalogId' => $catalogId]);
        }
    
        return $this->render('load_img', [
            'model'         => $model,
            'title'         => $this->getEntityValueTitle($entityId) . '. Изображения',
            'indexTitle'    => $this->getCatalogEntityTitle($catalogId),
            'catalogId'     => $catalogId,
            'entityId'      => $entityId,
        ]);
    }
    
    public function actionDeleteImg(
        int $entityId,
        int $catalogId,
        int $numGroup
    )
    {
        // TODO Нужна проверка, если удаляется фото, прикрепленное к нескольким продуктам!
        $service = new ImageTypeService;
        $service->delete($entityId, $numGroup);

        $this->redirect(['index', 'entityId' => $entityId, 'catalogId' => $catalogId]);
    }
    
    /**
     * Заголовок "Продукт '<Наименование>'"
     *
     * @param int $entityId
     * @return string
     */
    private function getEntityValueTitle(int $entityId): string
    {
        return sprintf(
            "Продукт '%s'",
            (new ParserEntityService())->getName($entityId)
        );
    }

    /**
     * Заголовок 'Каталог. Продукт'
     *
     * @param int $catalogId
     * @return string
     */
    private function getCatalogEntityTitle(int $catalogId): string
    {
        return sprintf(
            "%s. %s",
            (new CatalogService())->getName($catalogId),
            (new ParserEntityService())->getTitle()
        );
    }
    
    /**
     * @param int    $catalogId
     * @param int    $entityId
     * @param string $attributeName
     * @param int    $attributeId
     * @return string
     * @throws Exception
     */
    public function actionSimpleTypeSelect(
        int $catalogId,
        int $entityId,
        string $attributeName,
        int $attributeId
    ): string
    {
        $model = new SimpleTypeSelectForm();
    
        if ($this->request->isPost
            && $model->load($this->request->post())
        ) {
            (new SimpleTypeService)->copyValue(
                $entityId,
                $catalogId,
                $attributeId,
                intval($model->selectEntity)
            );
        
            $this->redirect(['index', 'entityId' => $entityId, 'catalogId' => $catalogId]);
        }
        
        return $this->render('simple-type-select', [
            'model'      => $model,
            'title'         => $this->getEntityValueTitle($entityId) . '. Значения',
            'indexTitle'    => $this->getCatalogEntityTitle($catalogId),
            'catalogId'     => $catalogId,
            'entityId'      => $entityId,
            'attributeName' => $attributeName,
            'entities' =>  ArrayHelper::map(
                (new ParserEntityService())->listByCatalog($catalogId, $entityId),
                'id',
                'name'
            ),
        ]);
    }
    
    /**
     * @param int $catalogId
     * @param int $entityId
     * @return string
     * @throws Exception
     */
    public function actionSimpleTypeSelectAll(
        int $catalogId,
        int $entityId
    ): string
    {
        $model = new SimpleTypeSelectForm();
    
        if ($this->request->isPost
            && $model->load($this->request->post())
        ) {
            (new SimpleTypeService)->copyValueAll(
                $entityId,
                $catalogId,
                intval($model->selectEntity)
            );
        
            $this->redirect(['index', 'entityId' => $entityId, 'catalogId' => $catalogId]);
        }
        
        return $this->render('simple-type-select-all', [
            'model'      => $model,
            'title'         => $this->getEntityValueTitle($entityId) . '. Значения',
            'indexTitle'    => $this->getCatalogEntityTitle($catalogId),
            'catalogId'     => $catalogId,
            'entityId'      => $entityId,
            'entities' =>  ArrayHelper::map(
                (new ParserEntityService())->listByCatalog($catalogId, $entityId),
                'id',
                'name'
            ),
        ]);
    }
    
}
