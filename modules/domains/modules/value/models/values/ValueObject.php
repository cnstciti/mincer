<?php declare(strict_types = 1);

namespace modules\domains\modules\value\models\values;

use Exception;
use modules\domains\BaseTable;
use modules\domains\Module as DomainsModule;
use modules\domains\modules\value\models\ValueService;
use Throwable;
use Yii;

abstract class ValueObject
{
    /**
     * Сохранение значения
     *
     * @param array $value
     */
    abstract protected function insertValueObject(array $value): void;
    
    /**
     * Получение модели
     *
     * @param int $valueId
     *
     * @return BaseTable
     */
    abstract public function getModel(int $valueId): BaseTable;
    
    /**
     * проверяем, существует ли такое значение в БД
     * если существует, то возвращаем ИД значения из БД
     *
     * @param array  $value
     * @param int    $dictionaryId
     * @param string $dictionaryName
     *
     * @return int
     * @throws Exception
     */
    abstract protected function existValue(
        array $value,
        int $dictionaryId,
        string $dictionaryName
    ): int;
    
    /**
     * вычислем само значение
     *
     * @param array  $value
     * @param int    $dictionaryId
     * @param string $dictionaryName
     *
     * @return int
     * @throws Exception
     */
    protected function computeValue(
        array $value,
        int $dictionaryId,
        string $dictionaryName
    )
    {
        return $value[$this->getValueName()];
    }
    
    public function getValueName(): string
    {
        return 'value';
    }
    
    /**
     * Вставки значениЙ
     *
     * @param array  $value
     * @param int    $typeId
     * @param int    $maxValueId
     * @param int    $dictionaryId
     * @param string $dictionaryName
     *
     * @return int
     * @throws Exception
     */
    public function insert(
        array $value,
        int $typeId,
        int &$maxValueId,
        int $dictionaryId,
        string $dictionaryName
    ): int {

        // нет значения - ничего не сохранием
        if ( ! $value['value']) {
            return 0;
        }
        
        // проверяем, существует ли такое значение в БД
        // если существует, то возвращаем ИД значения из БД
        if ($findValueId = $this->existValue($value, $dictionaryId, $dictionaryName)) {
            return $findValueId;
        }

        $transaction = DomainsModule::getInstance()->beginTransaction();
        try {
            $valueId = ++$maxValueId;
            $findValue = $this->computeValue($value, $dictionaryId, $dictionaryName);

            self::insertValue($valueId, $typeId);
            $this->insertValueObject([
                'valueId' => $valueId,
                'value'   => $findValue,
            ]);

            $transaction->commit();
        } catch (Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }

        return $valueId;
    }

    private function insertValue(int $valueId, int $typeValueId): void
    {
        try {
            Yii::$container->invoke(
                [
                    new ValueService,
                    'insert',
                ],
                [
                    'valueId' => $valueId,
                    'typeValueId' => $typeValueId,
                ]
            );
        } catch (Throwable $e) {
            throw new Exception(sprintf(
                'Ошибка вызова ValueService->insert: %s',
                $e->getMessage()
            ));
        }
    }

}