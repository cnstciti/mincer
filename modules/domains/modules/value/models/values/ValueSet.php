<?php declare(strict_types = 1);

namespace modules\domains\modules\value\models\values;

use Exception;
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
        int $dictionaryId,
        string $dictionaryName
    ): int {
        // ищем переданное значение в содержании словаря
        $dictionaryContent = $this->getDictionaryContent(
            $value,
            $dictionaryId,
            $dictionaryName
        );
        
        // ищем, существует ли запись с таком значением в БД
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
        int $dictionaryId,
        string $dictionaryName
    ): int {
        return $this->getDictionaryContent(
            $value,
            $dictionaryId,
            $dictionaryName
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
     * @param string $dictionaryName
     *
     * @return DictionaryContentTable
     * @throws Exception
     */
    private function getDictionaryContent(
        array $value,
        int $dictionaryId,
        string $dictionaryName
    ): DictionaryContentTable
    {
        $dictionaryContent = DictionaryContentTable::findOne([
            'value'        => $value['value'],
            'dictionaryId' => $dictionaryId,
        ]);
    
        if ( ! $dictionaryContent) {
            throw new Exception(sprintf(
                "Не найдено значение '%s' в справочнике '%s' (ИД: %d)",
                $value['value'],
                $dictionaryName,
                $dictionaryId
            ));
        }
    
        return $dictionaryContent;
    }

    
}