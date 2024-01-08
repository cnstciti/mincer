<?php declare(strict_types = 1);

namespace modules\domains\modules\attribute\controllers;

use Exception;
use modules\domains\Module as DomainsModule;
use modules\domains\modules\attribute\models\AttributeService;
use modules\domains\modules\attribute\models\CatalogAttributeService;
use modules\domains\modules\attribute\models\FullNameParamService;
use modules\domains\modules\catalog\models\CatalogService;
use modules\domains\modules\dictionary\models\DictionaryService;
use modules\domains\modules\type_value\models\TypeValueService;
use modules\domains\modules\unit\models\UnitService;
use Throwable;
use Yii;
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
     */
    public function actionIndex(int $catalogId): string
    {
        $title = self::getCatalogAttributeTitle($catalogId);
        
        return $this->render('index', [
            'title' => $title,
            'grid'  => $this->getGrid($title),
        ]);
    }
    
    /**
     * Создание атрибута
     *
     * @param int $catalogId
     *
     * @return string|Response
     * @throws Throwable
     */
    public function actionCreate(int $catalogId)
    {
        $attributeModel     = $this->getAttributeForm();
        $fullNameParamModel = $this->getFullNameParamForm();
        
        if ($this->request->isPost
            && $attributeModel->load($this->request->post())
            && $fullNameParamModel->load($this->request->post())
        ) {
            $transaction = DomainsModule::getInstance()->beginTransaction();
            try {
                $attributeModel->save();
                
                CatalogAttributeService::insert($catalogId, AttributeService::lastId());
                
                if ($sn = (int)$fullNameParamModel->sequenceNumber) {
                    FullNameParamService::insert(CatalogAttributeService::lastId(), $sn);
                }
                
                $transaction->commit();
            } catch (Throwable $e) {
                $transaction->rollBack();
                throw $e;
            }
            
            return $this->redirectIndex($catalogId);
        }
        
        return $this->render('create', [
            'attributeModel'     => $attributeModel,
            'fullNameParamModel' => $fullNameParamModel,
            'title'              => self::getCatalogAttributeTitle($catalogId),
            'catalogId'          => $catalogId,
            'units'              => UnitService::dataForSelect2(),
            'dictionaries'       => DictionaryService::dataForSelect2(),
            'types'              => TypeValueService::dataForSelect2(),
        ]);
    }
    
    /**
     * Редактирование атрибута
     *
     * @param int $attributeId
     * @param int $catalogId
     *
     * @return string|Response
     * @throws Exception
     */
    public function actionUpdate(int $attributeId, int $catalogId)
    {
        $attributeModel     = $this->getAttributeForm($attributeId);
        $fullNameParamModel = $this->getFullNameParamForm($attributeId, $catalogId);
    
        if ($this->request->isPost
            && $attributeModel->load($this->request->post())
            && $fullNameParamModel->load($this->request->post())
        ) {
            $transaction = DomainsModule::getInstance()->beginTransaction();
            try {
                $attributeModel->save();
            
                if ($fullNameParamModel->sequenceNumber) {
                    $sn = (int)$fullNameParamModel->sequenceNumber;
                    
                    if ($fullNameParamModel->id) {
                        FullNameParamService::update($fullNameParamModel->id, $sn);
                    } else {
                        FullNameParamService::insert(
                            CatalogAttributeService::getId($attributeId, $catalogId),
                            $sn
                        );
                    }
                } else {
                    FullNameParamService::delete($fullNameParamModel->id);
                }
            
                $transaction->commit();
            } catch (Throwable $e) {
                $transaction->rollBack();
                throw $e;
            }
        
            return $this->redirectIndex($catalogId);
        }

        return $this->render('update', [
            'attributeModel'     => $attributeModel,
            'fullNameParamModel' => $fullNameParamModel,
            'title'              => self::getCatalogAttributeTitle($catalogId),
            'catalogId'          => $catalogId,
            'units'              => UnitService::dataForSelect2(),
            'dictionaries'       => DictionaryService::dataForSelect2(),
            'types'              => TypeValueService::dataForSelect2(),
        ]);
    }
    
    /**
     * Выбор существующего арибута
     *
     * @param int $catalogId
     *
     * @return string|Response
     * @throws Exception
     */
    public function actionSelect(int $catalogId)
    {
        $model = $this->getSelectForm();
        
        if ($this->request->isPost
            && $model->load($this->request->post())
        ) {
            CatalogAttributeService::insert($catalogId, (int)$model->attributeId);
            
            return $this->redirectIndex($catalogId);
        }
        
        return $this->render('select', [
            'model'      => $model,
            'title'      => self::getCatalogAttributeTitle($catalogId),
            'catalogId'  => $catalogId,
            'attributes' => AttributeService::dataForSelect2(),
        ]);
    }
    
    /**
     * @param string $title
     *
     * @return mixed
     * @throws Exception
     */
    private function getGrid(string $title): mixed
    {
        try {
            return Yii::$container->invoke(
                [
                    new AttributeService,
                    'getGrid',
                ],
                [
                    'queryParams' => $this->request->queryParams,
                    'isEdit'      => DomainsModule::getInstance()->editAttribute(),
                    'title'       => $title,
                ]
            );
        } catch (Throwable $e) {
            throw new Exception(sprintf(
                'Ошибка вызова AttributeService->getGrid: %s',
                $e->getMessage()
            ));
        }
    }
    
    /**
     * @param int $attributeId
     *
     * @return mixed
     * @throws Exception
     */
    private function getAttributeForm(int $attributeId = 0): mixed
    {
        try {
            return Yii::$container->invoke(
                [
                    new AttributeService,
                    'getForm',
                ],
                [
                    'attributeId' => $attributeId,
                ]
            );
        } catch (Throwable $e) {
            throw new Exception(sprintf(
                'Ошибка вызова AttributeService->getForm: %s',
                $e->getMessage()
            ));
        }
    }
    
    /**
     * @param int $attributeId
     * @param int $catalogId
     *
     * @return mixed
     * @throws Exception
     */
    private function getFullNameParamForm(int $attributeId = 0, int $catalogId = 0)
    {
        try {
            $catalogAttributeId = CatalogAttributeService::getId($attributeId, $catalogId);
            
            return Yii::$container->invoke(
                [
                    new FullNameParamService,
                    'getForm',
                ],
                [
                    'catalogAttributeId' => $catalogAttributeId,
                ]
            );
        } catch (Throwable $e) {
            throw new Exception(sprintf(
                'Ошибка вызова FullNameParamService->getForm: %s',
                $e->getMessage()
            ));
        }
    }
    
    /**
     * @return mixed
     * @throws Exception
     */
    private function getSelectForm(): mixed
    {
        try {
            return Yii::$container->invoke(
                [
                    new AttributeService,
                    'getSelectForm',
                ]
            );
        } catch (Throwable $e) {
            throw new Exception(sprintf(
                'Ошибка вызова AttributeService->getSelectForm: %s',
                $e->getMessage()
            ));
        }
    }
    
    /**
     * @param int $catalogId
     *
     * @return string
     */
    private static function getCatalogAttributeTitle(int $catalogId): string
    {
        return sprintf(
            '%s. %s',
            CatalogService::getName($catalogId),
            AttributeService::getTitle()
        );
    }
    
    /**
     * @param int $catalogId
     *
     * @return Response
     */
    private function redirectIndex(int $catalogId): Response
    {
        return $this->redirect(['index', 'catalogId' => $catalogId]);
    }
    
}
