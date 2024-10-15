<?php declare(strict_types = 1);

namespace modules\domains\modules\value_enum\models;

use modules\domains\modules\values\models\IValueService;

class ValueEnumService implements IValueService
{
    
    /**
     * Получение модели
     *
     * @param int $valueId
     * @return ValueEnumTable
     */
    public function getModel(int $valueId): ValueEnumTable
    {
        return ValueEnumTable::findOne($valueId) ?? new ValueEnumTable;
    }
    
}
