<?php declare(strict_types = 1);

namespace modules\domains\modules\simple_type\models;

use Exception;
use modules\domains\modules\eav\models\EavService;
use modules\domains\modules\eav\models\EavTable;
use modules\domains\modules\set_type\models\SetTypeDataView;
use Throwable;

class SimpleTypeService
{
    
    /**
     * Грид для простых типов
     *
     * @param SimpleTypeSearch $searchModel
     * @param array            $queryParams
     * @param string           $title
     * @param int              $entityId
     * @param int              $catalogId
     * @return string
     * @throws Throwable
     */
    public function getGrid(
        SimpleTypeSearch $searchModel,
        array $queryParams,
        string $title,
        int $entityId,
        int $catalogId
    ): string
    {
        return SimpleTypeGrid::get(
            $searchModel,
            $searchModel->search($queryParams),
            $title,
            $entityId,
            $catalogId
        );
    }
    
    /**
     * @param int $entityId
     * @param int $catalogId
     * @param int $selectEntity
     * @throws Exception
     */
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
    
    /**
     * @param int $entityId
     * @param int $catalogId
     * @param int $attributeId
     * @param int $selectEntity
     * @throws Exception
     */
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
}
