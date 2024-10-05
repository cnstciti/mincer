<?php declare(strict_types = 1);

namespace modules\domains\modules\catalog\models;

use Exception;
use Throwable;
use yii\helpers\ArrayHelper;

class CatalogService
{
    private const TITLE = 'Каталоги';
    
    
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
     * @param CatalogSearch $searchModel
     * @param array         $queryParams
     * @param bool          $isEdit
     *
     * @return string
     * @throws Throwable
     */
    public function getGrid(
        CatalogSearch $searchModel,
        array $queryParams,
        bool $isEdit
    ): string
    {
        return CatalogGrid::get(
            $searchModel,
            $searchModel->search($queryParams),
            self::getTitle(),
            $isEdit
        );
    }
    
    /**
     * Форма
     *
     * @param CatalogForm $form
     * @param int         $catalogId
     *
     * @return CatalogForm
     * @throws Exception
     */
    public function getForm(CatalogForm $form, int $catalogId = 0): CatalogForm
    {
        $form = $catalogId ? $form::findOne($catalogId) : $form;
        
        if ( ! $form) {
            throw new Exception(sprintf(
                'Не найдена модель CatalogForm с ИД: %d',
                $catalogId
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
        $rows = CatalogTable::find()
                            ->select('id, name')
                            //->where('(isEndItem<>1 and isDelete=0) or id=1')
                            ->where('(containsProducts<>1) or id=1')
                            ->all();
        
        return ArrayHelper::map(
            $rows,
            'id',
            function ($row) {
                return sprintf(
                    '%s (ИД: %s)',
                    $row->name,
                    $row->id
                );
            }
        );
    }
    
    /**
     * Наименование
     *
     * @param int $catalogId
     *
     * @return string
     */
    public function getName(int $catalogId): string
    {
        return CatalogTable::findOne($catalogId)->name;
    }
    
}
