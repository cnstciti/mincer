<?php declare(strict_types=1);

namespace modules\domains\modules\value\models\values;

use Exception;

class ValueFactory
{
    
    /**
     * Создание объекта Значение по его типу
     *
     * @param string $type
     *
     * @return ValueObject
     * @throws Exception
     */
    public static function getValueObject(string $type): ValueObject
    {
        switch ($type) {
            case TypeValue::INT:    return new ValueInt();
            case TypeValue::FLOAT:  return new ValueFloat();
            case TypeValue::STRING: return new ValueString();
            case TypeValue::TEXT:   return new ValueText();
            case TypeValue::ENUM:
            case TypeValue::SET:    return new ValueSet();
            default:
                throw new Exception(sprintf(
                    'Не определен тип значения: %s',
                    $type
                ));
        }
    }
    
}