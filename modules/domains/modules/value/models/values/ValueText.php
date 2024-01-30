<?php declare(strict_types=1);

namespace modules\domains\modules\value\models\values;

use modules\domains\modules\value\models\ValueTextService;
use modules\domains\modules\value\models\ValueTextTable;

class ValueText extends ValueObject
{
    
    /**
     * {@inheritdoc}
     */
    public function existValue(
        array $value,
        int $dictionaryId
    ): int {
        // ищем, существует ли запись с таким значением в БД
        if ($valueText = ValueTextTable::findOne([
            'value' => $value['value']
        ])
        ) {
            return $valueText->id;
        }
        
        return 0;
    }
    
    /**
     * {@inheritdoc}
     */
    protected function insertValueObject(array $value): void
    {
        ValueTextService::insert($value['valueId'], $value['value']);
    }
    
    /**
     * {@inheritdoc}
     */
    public function getModel(int $valueId): ValueTextTable
    {
        return ValueTextService::getModel($valueId);
    }
}