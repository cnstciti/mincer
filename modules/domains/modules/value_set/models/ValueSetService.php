<?php declare(strict_types = 1);

namespace modules\domains\modules\value_set\models;

use Exception;
use modules\domains\modules\eav\models\EavService;
use modules\domains\modules\value\models\ValueService;
use Throwable;
use yii\helpers\ArrayHelper;

class ValueSetService
{
    
    /**
     * @param ValueSetTable $model
     * @param int           $catalogAttributeId
     * @param int           $catalogEntityId
     * @param int           $typeId
     * @throws Exception
     */
    public function update(
        ValueSetTable $model,
        int $catalogAttributeId,
        int $catalogEntityId,
        int $typeId
    ): void
    {
        if (!is_array($model->dictionaryContentId)) {
            return;
        }
        
        $eavService = new EavService();
        $eavService->delete($catalogEntityId, $catalogAttributeId);
        
        foreach ($model->dictionaryContentId as $item) {
            // определяем $valueId
            $valueId = 0;
            if ($setRow = $model::findOne([
                'dictionaryContentId' => intval($item)
            ])) {
                $valueId = $setRow->id;
            }
            
            if ( ! $valueId) {
                $valueId = (new ValueService)->insert($typeId);
                $this->insert($valueId, intval($item));
            }
            
            $eavService->insert(
                $catalogEntityId,
                $catalogAttributeId,
                $valueId
            );
        }
    }
    
    /**
     * сохранение
     *
     * @param int $id
     * @param int $dictionaryContentId
     * @throws Exception
     */
    public function insert(int $id, int $dictionaryContentId): void
    {
        try {
            $t                      = new ValueSetTable;
            $t->id                  = $id;
            $t->dictionaryContentId = $dictionaryContentId;
            $t->save();
        } catch (Throwable $e) {
            throw new Exception('Ошибка при создании ValueIntTable. ' . $e->getMessage());
        }
    }
    
    /**
     * Получение модели
     *
     * @param int $catalogAttributeId
     * @param int $catalogEntityId
     * @return ValueSetTable
     */
    public function getModel(int $catalogAttributeId, int $catalogEntityId): ValueSetTable
    {
        $result = new ValueSetTable;
        if ($catalogAttributeId && $catalogEntityId) {
            $res = ValueSetTable::find()
                                ->leftJoin(['v' => 'value'], 'v.id=value_set.id')
                                ->leftJoin('eav', 'v.id=eav.valueId')
                                ->where([
                                    'catalogEntityId'    => $catalogEntityId,
                                    'catalogAttributeId' => $catalogAttributeId,
                                ])
                                ->all();
            
            $result->dictionaryContentId = ArrayHelper::map(
                $res,
                'id',
                'dictionaryContentId'
            );
        }
        
        return $result;
    }
    
}
