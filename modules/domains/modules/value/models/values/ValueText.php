<?php declare(strict_types=1);

namespace modules\domains\modules\value\models\values;

use Exception;
use modules\domains\modules\value\models\ValueTextService;
use modules\domains\modules\value\models\ValueTextTable;
use Throwable;
use Yii;

class ValueText extends ValueObject
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
        try {
            Yii::$container->invoke(
                [
                    new ValueTextService,
                    'insert',
                ],
                [
                    'id' => (int)$value['valueId'],
                    'value' => $value['value'],
                ]
            );
        } catch (Throwable $e) {
            throw new Exception(sprintf(
                'Ошибка вызова ValueTextService->insert: %s',
                $e->getMessage()
            ));
        }
    }
    
    /**
     * {@inheritdoc}
     */
    public function getModel(int $valueId): ValueTextTable
    {
        return ValueTextService::getModel($valueId);
    }
}