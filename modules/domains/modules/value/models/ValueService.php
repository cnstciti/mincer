<?php declare(strict_types = 1);

namespace modules\domains\modules\value\models;

use Exception;
use Throwable;

class ValueService
{
    
    /**
     * сохранение
     *
     * @param int $typeValueId
     * @return int
     * @throws Exception
     */
    public function insert(int $typeValueId): int
    {
        try {
            $t              = new ValueTable();
            $t->typeValueId = $typeValueId;
            $t->save();
        } catch (Throwable $e) {
            throw new Exception('Ошибка при создании ValueTable. ' . $e->getMessage());
        }
        
        return ValueTable::lastId();
    }
    
}
