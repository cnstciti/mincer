<?php declare(strict_types = 1);

namespace modules\domains\modules\value\models\values;

use modules\domains\modules\value\models\ValueStringService;
use modules\domains\modules\value\models\ValueStringTable;

class ValueString extends ValueObject
{
    
    /**
     * {@inheritdoc}
     */
    public function existValue(
        array $value,
        int $dictionaryId,
        string $dictionaryName
    ): int {
        // ищем, существует ли запись с таком значением в БД
        if ($valueString = ValueStringTable::findOne([
            'value' => $value['value']
        ])
        ) {
            return $valueString->id;
        }
        
        return 0;
    }
    
    /**
     * {@inheritdoc}
     */
    protected function insertValueObject(array $value): void
    {
        ValueStringService::insert($value['valueId'], $value['value']);
    }
    
    /**
     * {@inheritdoc}
     */
    public function getModel(int $valueId): ValueStringTable
    {
        return ValueStringService::getModel($valueId);
    }
    
}