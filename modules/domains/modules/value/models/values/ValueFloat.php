<?php declare(strict_types=1);

namespace modules\domains\modules\value\models\values;

use Exception;
use modules\domains\modules\value\models\ValueFloatService;
use modules\domains\modules\value\models\ValueFloatTable;
use Throwable;
use Yii;

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
        try {
            Yii::$container->invoke(
                [
                    new ValueFloatService,
                    'insert',
                ],
                [
                    'id' => (int)$value['valueId'],
                    'value' => (float)$value['value'],
                ]
            );
        } catch (Throwable $e) {
            throw new Exception(sprintf(
                'Ошибка вызова ValueFloatService->insert: %s',
                $e->getMessage()
            ));
        }
    }
    
    /**
     * {@inheritdoc}
     */
    public function getModel(int $valueId): ValueFloatTable
    {
        return ValueFloatService::getModel($valueId);
    }
    
}