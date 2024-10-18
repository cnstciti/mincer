<?php declare(strict_types = 1);

namespace common\models\services;

use common\models\forms\CatalogForm;
use common\models\grids\CatalogGrid;
use common\models\searches\CatalogSearch;
use common\models\tables\CatalogTable;
use Exception;
use Throwable;
use yii\helpers\ArrayHelper;

class CatalogService
{
    private const TITLE = 'Каталоги';
    
    
    /**
     * Заголовок
     * @return string
     */
    public function title(): string
    {
        return self::TITLE;
    }
    
    /**
     * Грид
     * @param CatalogSearch $searchModel
     * @param array         $queryParams
     * @param bool          $isEdit
     * @return string
     * @throws Throwable
     */
    public function grid(
        array $queryParams,
        bool $isEdit
    ): string
    {
        $searchModel = new CatalogSearch();
        
        return CatalogGrid::get(
            $searchModel,
            $searchModel->search($queryParams),
            self::title(),
            $isEdit
        );
    }
    
    /**
     * Форма
     * @param int $catalogId
     * @return CatalogForm
     * @throws Exception
     */
    public function form(int $catalogId = 0): CatalogForm
    {
        $form = $catalogId ? CatalogForm::findOne($catalogId) : new CatalogForm();
        
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
     * @return array
     */
    public function mapIdName(): array
    {
        $rows = CatalogTable::find()
                            ->select('id, name')
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
     * @param int $catalogId
     * @return string
     */
    public function name(int $catalogId): string
    {
        return CatalogTable::findOne($catalogId)->name;
    }
    
}
