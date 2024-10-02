<?php declare(strict_types = 1);

namespace modules\domains\modules\unit\models;

use Exception;
use Throwable;
use yii\helpers\ArrayHelper;

class UnitService
{
    private const TITLE = 'Единицы измерения';
    
    
    /**
     * Заголовок
     *
     * @return string
     */
    public function getTitle(): string
    {
        return self::TITLE;
    }
    
    /**
     * Грид
     *
     * @param UnitSearch $searchModel
     * @param array      $queryParams
     * @param bool       $isEdit
     *
     * @return string
     * @throws Throwable
     */
    public function getGrid(
        UnitSearch $searchModel,
        array $queryParams,
        bool $isEdit
    ): string {
        return UnitGrid::get(
            $searchModel,
            $searchModel->search($queryParams),
            $this->getTitle(),
            $isEdit
        );
    }
    
    /**
     * Форма
     *
     * @param UnitForm $form
     * @param int      $unitId
     *
     * @return UnitForm
     * @throws Exception
     */
    public function getForm(UnitForm $form, int $unitId = 0): UnitForm
    {
        $form = $unitId ? $form::findOne($unitId) : $form;
        
        if ( ! $form) {
            throw new Exception(sprintf(
                'Не найдена модель UnitForm с ИД: %d',
                $unitId
            ));
        }
        
        return $form;
    }
    
    /**
     * данные для select2
     *
     * @return array
     */
    public function dataForSelect2(): array
    {
        return ArrayHelper::map(
        UnitTable::findAll([/*'isDelete' => 0*/]),
            'id',
            function ($row) {
                return sprintf(
                    '%s (%s)',
                    $row->shortName,
                    $row->name
                );
            });
    }
    
}
