<?php declare(strict_types = 1);

namespace modules\domains\modules\set_type\models;

use Throwable;

class SetTypeService
{
    
    /**
     * Грид для простых типов
     *
     * @param SetTypeSearch $searchModel
     * @param array            $queryParams
     * @param string           $title
     * @return string
     * @throws Throwable
     */
    public function getGrid(
        SetTypeSearch $searchModel,
        array $queryParams,
        string $title
    ): string
    {
        return SetTypeGrid::get(
            $searchModel,
            $searchModel->search($queryParams),
            $title
        );
    }
    
}
