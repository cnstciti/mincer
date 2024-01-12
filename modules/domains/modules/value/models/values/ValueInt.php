<?php declare(strict_types=1);

namespace modules\domains\modules\value\models\values;

use Exception;
use modules\domains\modules\value\models\ValueIntService;
use modules\domains\modules\value\models\ValueIntTable;
use Throwable;
use Yii;

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
        try {
            Yii::$container->invoke(
                [
                    new ValueIntService,
                    'insert',
                ],
                [
                    'id' => (int)$value['valueId'],
                    'value' => (int)$value['value'],
                ]
            );
        } catch (Throwable $e) {
            throw new Exception(sprintf(
                'Ошибка вызова ValueIntService->insert: %s',
                $e->getMessage()
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getModel(int $valueId): ValueIntTable
    {
        return ValueIntService::getModel($valueId);
    }

}