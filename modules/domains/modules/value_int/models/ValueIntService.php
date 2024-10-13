<?php declare(strict_types = 1);

namespace modules\domains\modules\value_int\models;

use modules\domains\modules\values\models\IValueService;

class ValueIntService implements IValueService
{
    
    /**
     * Получение модели
     *
     * @param int $valueId
     * @return ValueIntTable
     */
    public function getModel(int $valueId): ValueIntTable
    {
        return ValueIntTable::findOne($valueId) ?? new ValueIntTable;
    }
    
}
