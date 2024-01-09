<?php declare(strict_types=1);

namespace modules\domains\modules\value\models\values;

use modules\domains\modules\value\models\ValueIntService;
use modules\domains\modules\value\models\ValueIntTable;

class ValueInt extends ValueObject
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
        if ($valueInt = ValueIntTable::findOne(['value' => $value['value']])) {
            return $valueInt->id;
        }
        
        return 0;
    }
    
    /**
     * {@inheritdoc}
     */
    protected function insertValueObject(array $value): void
    {
        ValueIntService::insert((int)$value['valueId'], (int)$value['value']);
    }
    
    /**
     * {@inheritdoc}
     */
    public function getModel(int $valueId): ValueIntTable
    {
        return ValueIntService::getModel($valueId);
    }

}