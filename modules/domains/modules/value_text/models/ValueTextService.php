<?php declare(strict_types = 1);

namespace modules\domains\modules\value_text\models;

use modules\domains\modules\values\models\IValueService;

class ValueTextService implements IValueService
{
    
    /**
     * Получение модели
     *
     * @param int $valueId
     * @return ValueTextTable
     */
    public function getModel(int $valueId): ValueTextTable
    {
        return ValueTextTable::findOne($valueId) ?? new ValueTextTable;
    }
    
}
