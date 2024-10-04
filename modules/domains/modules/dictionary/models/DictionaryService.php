<?php declare(strict_types = 1);

namespace modules\domains\modules\dictionary\models;

use Exception;
use Throwable;
use yii\helpers\ArrayHelper;

class DictionaryService
{
    private const TITLE = 'Словари';
    
    
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
     * @param DictionarySearch $searchModel
     * @param array            $queryParams
     * @param bool $isEdit
     *
     * @return string
     * @throws Throwable
     */
    public function getGrid(
        DictionarySearch $searchModel,
        array $queryParams,
        bool $isEdit
    ): string
    {
        return DictionaryGrid::get(
            $searchModel,
            $searchModel->search($queryParams),
            self::getTitle(),
            $isEdit
        );
    }
    
    /**
     * Форма
     *
     * @param DictionaryForm $form
     * @param int            $dictionaryId
     *
     * @return DictionaryForm
     * @throws Exception
     */
    public function getForm(DictionaryForm $form, int $dictionaryId = 0): DictionaryForm
    {
        $form = $dictionaryId ? $form::findOne($dictionaryId) : $form;
        
        if ( ! $form) {
            throw new Exception(sprintf(
                "Не найдена модель DictionaryForm с ИД: %d",
                $dictionaryId
            ));
        }
        
        return $form;
    }
    
    /**
     * Наименование
     *
     * @param int $dictionaryId
     *
     * @return string
     */
    public function getName(int $dictionaryId): string
    {
        return DictionaryTable::findOne($dictionaryId)->name;
    }

    /**
     * данные для select2
     *
     * @return array
     */
    public function dataForSelect2(): array
    {
        return ArrayHelper::map(
            DictionaryTable::findAll([/*'isDelete' => 0*/]),
            'id',
            'name'
        );
    }
    
}
