<?php declare(strict_types = 1);

namespace modules\domains\modules\value_image\models;

use modules\domains\modules\values\models\IValueService;

class ValueImageService implements IValueService
{
    
    /**
     * Получение модели
     *
     * @param int $id
     * @return ValueImageTable
     */
    public function getModel(int $id=0): ValueImageTable
    {
        return ValueImageTable::findOne($id) ?? new ValueImageTable;
    }
}
