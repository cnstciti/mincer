<?php declare(strict_types = 1);

namespace modules\domains\modules\values\models;

use Exception;
use modules\domains\BaseTable;
use modules\domains\modules\eav\models\EavService;
use modules\domains\modules\type_value\models\TypeValueService;
use modules\domains\modules\value\models\ValueService;
use modules\domains\modules\value_enum\models\ValueEnumService;
use modules\domains\modules\value_float\models\ValueFloatService;
use modules\domains\modules\value_int\models\ValueIntService;
use modules\domains\modules\value_string\models\ValueStringService;
use modules\domains\modules\value_text\models\ValueTextService;

class ValuesService
{
    
    /**
     * @param string $type
     * @param int    $valueId
     * @return BaseTable
     * @throws Exception
     */
    public function getModelByType(string $type, int $valueId): BaseTable
    {
        switch ($type) {
            case TypeValueService::INT:     return (new ValueIntService)->getModel($valueId);
            case TypeValueService::FLOAT:   return (new ValueFloatService)->getModel($valueId);
            case TypeValueService::STRING:  return (new ValueStringService)->getModel($valueId);
            case TypeValueService::TEXT:    return (new ValueTextService)->getModel($valueId);
            case TypeValueService::ENUM:    return (new ValueEnumService)->getModel($valueId);
            
            default: throw new Exception(sprintf(
                    'Не определен тип значения: %s',
                    $type
                ));
        }
    }
    
    /**
     * Обновление данных переданной модели
     *
     * @param BaseTable $model
     * @param int       $catalogAttributeId
     * @param int       $catalogEntityId
     * @param int       $typeId
     * @throws Exception
     */
    public function update(
        BaseTable $model,
        int $catalogAttributeId,
        int $catalogEntityId,
        int $typeId
    ): void
    {
        // определяем $valueId
        $valueId = $this->existValue($model);
        if (!$valueId) {
            // создаем - во всех связных таблицах
            $valueId = (new ValueService)->insert($typeId);
            $value = $model->computeValue();
            $model->insertValueObject($valueId, $value);
        }
        
        $eavService = new EavService();
        if ($eavService->isExist($catalogEntityId, $catalogAttributeId)) {
            $eavService->update(
                $catalogEntityId,
                $catalogAttributeId,
                $valueId
            );
        } else {
            $eavService->insert(
                $catalogEntityId,
                $catalogAttributeId,
                $valueId
            );
        }
    }
    
    /**
     * Вычисляет, существует ли уже такое значение в модели.
     * Если существует, то возвращает ИД записи
     *
     * @param BaseTable $model
     * @return int
     */
    private function existValue(BaseTable $model): int
    {
        // ищем, существует ли запись с таком значением в БД
        if ($value = $model::findOne([
            $model->getValueName() => $model->computeValue()
        ])) {
            return $value->id;
        }
        
        return 0;
    }
    
    //---------------------
    

    
   /*
    public function getSimpleTypeForDemo(int $entityId, int $catalogId): array
    {
        return SimpleTypeDataView::find()
                              ->where([
                                  'entityId'  => $entityId,
                                  'catalogId' => $catalogId,
                              ])
                              ->all();
    }

    public function getSetTypeForDemo(int $entityId, int $catalogId): array
    {
        return SetTypeDataView::find()
                              ->where([
                                  'entityId'  => $entityId,
                                  'catalogId' => $catalogId,
                              ])
                              ->all();
    }
    
    public function copyValue(
        int $entityId,
        int $catalogId,
        int $attributeId,
        int $selectEntity
    ): void
    {
        // это eav ВЫБРАННОГО продукта
        $eavViewSelect = SimpleTypeDataView::findOne([
            'catalogId'   => $catalogId,
            'entityId'    => $selectEntity,
            'attributeId' => $attributeId,
        ]);
        
        // это eav продукта, куда копируется значение атрибута
        $eavView = SimpleTypeDataView::findOne([
            'catalogId'   => $catalogId,
            'entityId'    => $entityId,
            'attributeId' => $attributeId,
        ]);
        
        if ($eavView->eavId) {
            $eav          = EavTable::findOne(['id' => $eavView->eavId]);
            $eav->valueId = $eavViewSelect->valueId;
            $eav->save();
        } elseif ($eavViewSelect->valueId) {
            (new EavService)->insert(
                $eavView->catalogEntityId,
                $eavView->catalogAttributeId,
                $eavViewSelect->valueId
            );
        }
    }
    
    public function copyValueAll(
        int $entityId,
        int $catalogId,
        int $selectEntity
    ): void
    {
        $attributes = SimpleTypeDataView::findAll([
            'catalogId'   => $catalogId,
            'entityId'    => $selectEntity,
        ]);
        
        foreach ($attributes as $item) {
            $this->copyValue(
                $entityId,
                $catalogId,
                $item->attributeId,
                $selectEntity
            );
        }
    }
    */
}
