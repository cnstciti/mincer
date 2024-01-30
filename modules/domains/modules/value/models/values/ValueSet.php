<?php declare(strict_types = 1);

namespace modules\domains\modules\value\models\values;

use Exception;
use modules\domains\modules\dictionary\models\DictionaryTable;
use modules\domains\modules\dictionary_content\models\DictionaryContentTable;
use modules\domains\modules\value\models\ValueSetService;
use modules\domains\modules\value\models\ValueSetTable;

class ValueSet extends ValueObject
{
    
    /**
     * {@inheritdoc}
     */
    protected function existValue(
        array $value,
        int $dictionaryId
    ): int {
        // ищем переданное значение в содержании словаря
        $dictionaryContent = $this->getDictionaryContent(
            $value,
            $dictionaryId
        );
        
        // ищем, существует ли запись с таким значением в БД
        if ($valueSet = ValueSetTable::findOne([
                'dictionaryContentId' => $dictionaryContent->id
            ])
        ) {
            return $valueSet->id;
        }
        
        return 0;
    }
    
    /**
     * {@inheritdoc}
     */
    protected function computeValue(
        array $value,
        int $dictionaryId
    ): int {
        return $this->getDictionaryContent(
            $value,
            $dictionaryId
        )->id;
    }
    
    /**
     * {@inheritdoc}
     */
    public function insertValueObject(array $value): void
    {
        ValueSetService::insert($value['valueId'], $value['value']);
    }
    
    /**
     * {@inheritdoc}
     */
    public function getModel(int $valueId): ValueSetTable
    {
        return ValueSetService::getModel($valueId);
    }
    
    /**
     * {@inheritdoc}
     */
    public function getValueName(): string
    {
        return 'dictionaryId';
    }
    
    /**
     * @param array  $value
     * @param int    $dictionaryId
     *
     * @return DictionaryContentTable
     * @throws Exception
     */
    private function getDictionaryContent(array $value, int $dictionaryId): DictionaryContentTable
    {
        $this->checkParamDictionaryContent($value, $dictionaryId);

        $dictionaryContent = DictionaryContentTable::findOne([
            'value'        => $value['value'],
            'dictionaryId' => $dictionaryId,
        ]);
    
        if ( ! $dictionaryContent) {
            throw new Exception(sprintf(
                "Не найдено значение '%s' в справочнике '%s' (ИД: %d)",
                $value['value'],
                DictionaryTable::findOne(['id' => $dictionaryId])->name,
                $dictionaryId
            ));
        }
    
        return $dictionaryContent;
    }

    /**
     * @param array $value
     * @param int $dictionaryId
     * @return void
     * @throws Exception
     */
    private function checkParamDictionaryContent(array $value, int $dictionaryId): void
    {
        if (!$value['value']) {
            throw new Exception("Не определен параметр 'value[value]'");
        }
        if (!$dictionaryId) {
            throw new Exception("Не определен параметр 'dictionaryId'");
        }
    }

}