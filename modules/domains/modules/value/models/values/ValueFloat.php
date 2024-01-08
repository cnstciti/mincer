<?php declare(strict_types=1);

namespace modules\domains\modules\value\models\values;

use modules\domains\modules\value\models\ValueFloatService;
use modules\domains\modules\value\models\ValueFloatTable;

class ValueFloat extends ValueObject
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
        if ($valueFloat = ValueFloatTable::findOne([
            'value' => $value['value']
        ])
        ) {
            return $valueFloat->id;
        }
        
        return 0;
    }
    
    /**
     * {@inheritdoc}
     */
    protected function insertValueObject(array $value): void
    {
        ValueFloatService::insert((int)$value['valueId'], (float)$value['value']);
    }
    
    /**
     * {@inheritdoc}
     */
    public function getModel(int $valueId): ValueFloatTable
    {
        return ValueFloatService::getModel($valueId);
    }
    
}