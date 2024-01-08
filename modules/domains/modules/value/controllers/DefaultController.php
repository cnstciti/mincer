<?php declare(strict_types = 1);

namespace modules\domains\modules\value\controllers;

use Exception;
use modules\domains\modules\catalog\models\CatalogService;
use modules\domains\modules\dictionary_content\models\DictionaryContentService;
use modules\domains\modules\entity\models\EntityService;
use modules\domains\modules\type_value\models\TypeValueService;
use modules\domains\modules\value\models\EavService;
use modules\domains\modules\value\models\values\ValueFactory;
use modules\domains\modules\value\models\ValueService;
use Throwable;
use Yii;
use yii\web\Controller;

class DefaultController extends Controller
{
    
    /**
     * Список значений
     *
     * @param int $entityId
     * @param int $catalogId
     *
     * @return string
     * @throws Exception
     */
    public function actionIndex(int $entityId, int $catalogId): string
    {
        $title = self::getEntityValueTitle($entityId);
        
        return $this->render('index', [
            'title'      => $title,
            'grid'       => $this->getGrid($title),
            'catalogId'  => $catalogId,
            'indexTitle' => $this->getCatalogEntityTitle($catalogId),
        ]);
    }
    
    /**
     * Редактирование значения
     *
     * @param int $typeValueId
     * @param int $valueId
     * @param int $entityId
     * @param int $catalogId
     * @param int $catalogAttributeId
     * @param int $dictionaryId
     *
     * @return string
     * @throws Exception
     */
    public function actionUpdate(
        int $typeValueId,
        int $valueId,
        int $entityId,
        int $catalogId,
        int $catalogAttributeId,
        int $dictionaryId
    ) {
        $typeName = TypeValueService::getName($typeValueId);
        
        $valueObject = ValueFactory::getValueObject($typeName);
        
        $model = $valueObject->getModel($valueId);
        
        if ($this->request->isPost
            && $model->load($this->request->post())
        ) {
            $valueName = $valueObject->getValueName();
            if ($model->getAttribute($valueName) != $model->getOldAttribute($valueName)) {
                $value          = [
                    'valueId' => $valueId,
                    'value'   => $model->getAttribute($valueName),
                ];
                $dictionaryId   = $model->hasAttribute('dictionaryId')
                    ? $model->dictionaryId
                    : 0;
                $dictionaryName = $model->hasAttribute('dictionaryName')
                    ? $model->dictionaryName
                    : '';
                
                // TODO в транзакцию упаковать
                
                $newValueId = $valueObject->insert(
                    $value,
                    $typeValueId,
                    ValueService::lastId(),
                    $dictionaryId,
                    $dictionaryName
                );
                EavService::updateValueId(
                    $entityId,
                    $catalogAttributeId,
                    $valueId,
                    $newValueId
                );
            }
            
            $this->redirect(['index', 'entityId' => $entityId, 'catalogId' => $catalogId]);
        }
    /*
     * определить выбранные значения в селект2
     * сделать икл по значениям
     * подумать, может лстальные случаи привести к массиву?
        $request = "
            SELECT idDictionaryContent
              FROM value_set
             WHERE (value_set.idEntity=:idEntity) AND (value_set.idAttribute=:idAttribute)
        ";
    
        return self::getDb()->createCommand($request)
                   ->bindValue(':idEntity', $idEntity)
                   ->bindValue(':idAttribute', $idAttribute)
                   ->queryAll();
    */
        return $this->render('update', [
            'model'        => $model,
            'title'        => self::getEntityValueTitle($entityId),
            'indexTitle'   => self::getCatalogEntityTitle($catalogId),
            'catalogId'    => $catalogId,
            'entityId'     => $entityId,
            'typeName'     => $typeName,
            'dictionaries' => DictionaryContentService::dataForSelect2($dictionaryId),
            
            /* 'attributeModel'     => $attributeModel,
             'fullNameParamModel' => $fullNameParamModel,
             'title'              => self::getCatalogAttributeTitle($catalogId),
             'units'              => UnitService::dataForSelect2(),
             'types'              => TypeValueService::dataForSelect2(),*/
        ]);
    }
    /*
    public function actionUpdate(string $type, int $idAttribute, int $idDictionary, int $idEntity, int $idCatalog)
    {
        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->idEntity = $idEntity;
            $model->idAttribute = $idAttribute;
    
            try {
                switch ($type) {
                    case FieldType::BOOL:
                    case FieldType::FLOAT:
                    case FieldType::INT:
                    case FieldType::STRING:
                    case FieldType::TEXT:
                        if ($model->value) {
                            $model->save();
                        }
                        break;
                    case FieldType::ENUM:
                        if ($model->idDictionaryContent) {
                            $model->save();
                        }
                        break;
                    case FieldType::SET:
                        foreach ($model->idDictionaryContent as $idDictionaryContent) {
                            $row = DictionaryContent::find()->where(['id' => $idDictionaryContent])->one();
                            if (!$row) {
                                throw new Exception('Не найдено значение: ' . $idDictionaryContent);
                            }
                        }
                        $model::deleteAll(['idEntity' => $idEntity, 'idAttribute' => $idAttribute]);
                        if (is_array($model->idDictionaryContent)) {
                            foreach ($model->idDictionaryContent as $v) {
                                $row = new ValueSet();
                                $row->idEntity = $idEntity;
                                $row->idAttribute = $idAttribute;
                                $row->idDictionaryContent = $v;
                                $row->isDelete = $model->isDelete;
                                $row->isVisible = $model->isVisible;
                                $row->save();
                            }
                        }
                        break;
                    default:
                        throw new Exception('Не найден тип поля: ' . $type);
                }
            } catch (Exception $e) {
                throw new RuntimeException('Ошибка обновления: ' . $e);
            }

            return $this->redirect(['index', 'idEntity' => $idEntity, 'idCatalog' => $idCatalog]);
        }

     */
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
                    new ValueService,
                    'getGrid',
                ],
                [
                    'queryParams' => $this->request->queryParams,
                    'title'       => $title,
                ]
            );
        } catch (Throwable $e) {
            throw new Exception(sprintf(
                'Ошибка вызова ValueService->getGrid: %s',
                $e->getMessage()
            ));
        }
    }
    
    /**
     * @param int $entityId
     *
     * @return string
     */
    private static function getEntityValueTitle(int $entityId): string
    {
        return sprintf(
            "Продукт '%s'. %s",
            EntityService::getName($entityId),
            ValueService::getTitle()
        );
    }
    
    private static function getCatalogEntityTitle(int $catalogId): string
    {
        return sprintf(
            "%s. %s",
            CatalogService::getName($catalogId),
            EntityService::getTitle()
        );
    }
    
}
