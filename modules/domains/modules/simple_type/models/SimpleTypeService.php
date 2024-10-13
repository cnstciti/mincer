<?php declare(strict_types = 1);

namespace modules\domains\modules\simple_type\models;

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
    
}
