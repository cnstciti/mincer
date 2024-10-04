<?php declare(strict_types = 1);

namespace modules\domains\modules\dictionary_content\models;

use Exception;
use Throwable;
use yii\helpers\ArrayHelper;

class DictionaryContentService
{
    private const TITLE = 'Содержания словаря';
    
    
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
     * @param DictionaryContentSearch $searchModel
     * @param array                   $queryParams
     * @param bool                    $isEdit
     * @param string                  $title
     *
     * @return string
     * @throws Throwable
     */
    public function getGrid(
        DictionaryContentSearch $searchModel,
        array $queryParams,
        bool $isEdit,
        string $title
    ): string
    {
        return DictionaryContentGrid::get(
            $searchModel,
            $searchModel->search($queryParams),
            $title,
            $isEdit,
            (int)$queryParams['dictionaryId'],
        );
    }
    
    /**
     * Форма
     *
     * @param DictionaryContentForm $form
     * @param int                   $dictionaryContentId
     *
     * @return DictionaryContentForm
     * @throws Exception
     */
    public function getForm(
        DictionaryContentForm $form,
        int $dictionaryContentId = 0
    ): DictionaryContentForm
    {
        $form = $dictionaryContentId ? $form::findOne($dictionaryContentId) : $form;
        
        if ( ! $form) {
            throw new Exception(sprintf(
                "Не найдена модель DictionaryContentForm с ИД: %d",
                $dictionaryContentId
            ));
        }
        
        return $form;
    }
    
    /**
     * данные для select2
     *
     * @return array
     */
    public function dataForSelect2(int $dictionaryId): array
    {
        return ArrayHelper::map(
            DictionaryContentTable::findAll(['dictionaryId' => $dictionaryId/*, 'isDelete' => 0*/]),
            'id',
            'value'
        );
    }
    
}
