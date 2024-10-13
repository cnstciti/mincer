<?php declare(strict_types = 1);

namespace modules\domains\modules\value_float\models;

use modules\domains\modules\values\models\IValueService;

class ValueFloatService implements IValueService
{
    
    /**
     * Получение модели
     *
     * @param int $valueId
     * @return ValueFloatTable
     */
    public function getModel(int $valueId): ValueFloatTable
    {
        return ValueFloatTable::findOne($valueId) ?? new ValueFloatTable;
    }
    
}
