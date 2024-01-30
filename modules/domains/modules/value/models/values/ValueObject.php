<?php declare(strict_types = 1);

namespace modules\domains\modules\value\models\values;

use Exception;
use modules\domains\BaseTable;
use modules\domains\modules\value\models\ValueService;

abstract class ValueObject
{
    /**
     * Сохранение значения
     *
     * @param array $value
     *
     * @return mixed
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
     //* @param string $dictionaryName
     *
     * @return int
     * @throws Exception
     */
    abstract protected function existValue(
        array $value,
        int $dictionaryId
    ): int;
    
    /**
     * вычислем само значение
     *
     * @param array  $value
     * @param int    $dictionaryId
     *
     * @return int
     * @throws Exception
     */
    protected function computeValue(
        array $value,
        int $dictionaryId
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
     * @param array  $value     // ['valueId' => ?int, 'value' => ?mixed]
     * @param int    $typeId
     * @param int    $maxValueId
     * @param int    $dictionaryId
     *
     * @return int
     * @throws Exception
     */
    public function insert(
        array $value,
        int $typeId,
        int &$maxValueId,
        int $dictionaryId
    ): int {

        // нет значения - ничего не сохранием
        if ( ! $value['value']) {
            return 0;
        }
        
        // проверяем, существует ли такое значение в БД
        // если существует, то возвращаем ИД значения из БД
        if ($findValueId = $this->existValue($value, $dictionaryId)) {
            return $findValueId;
        }

// TODO обвернуть в транзакию
        
        $valueId = ++$maxValueId;

        ValueService::insert($valueId, $typeId);
        $this->insertValueObject([
            'valueId' => $valueId,
            'value'   => $this->computeValue($value, $dictionaryId),
        ]);
        
        return $valueId;
    }
    
}