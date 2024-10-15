<?php declare(strict_types = 1);

namespace modules\domains\modules\value_string\models;

use modules\domains\modules\values\models\IValueService;

class ValueStringService implements IValueService
{
    
    /**
     * Получение модели
     *
     * @param int $valueId
     * @return ValueStringTable
     */
    public function getModel(int $valueId): ValueStringTable
    {
        return ValueStringTable::findOne($valueId) ?? new ValueStringTable;
    }
    
}
