<?php declare(strict_types = 1);

namespace modules\domains\modules\values\models;

use Exception;

interface IValueModel
{
    /**
     * Вставка значения в Value*****Table
     *
     * @param int $valueId
     * @param mixed $value
     * @throws Exception
     */
    public function insertValueObject(int $valueId, $value): void;
    
    /**
     * Вычислем само значение из модели
     *
     * @return mixed
     */
    public function computeValue();
    
    /**
     * Возвращает наименование поля модели, где хранится само значение
     *
     * @return string
     */
    public function getValueName(): string;

}