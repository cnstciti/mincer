<?php declare(strict_types = 1);

namespace modules\domains\modules\values\models;

use modules\domains\BaseTable;

interface IValueService
{
    /**
     * Получение модели
     *
     * @param int $valueId
     * @return BaseTable
     */
    public function getModel(int $valueId): BaseTable;
}