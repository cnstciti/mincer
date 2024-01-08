<?php declare(strict_types = 1);

namespace modules\domains\modules\import\models;

use Exception;

class ImportGetData
{
    public static $data = null;
    
    
    /**
     * Получение catalogId
     *
     * @return int
     * @throws Exception
     */
    public static function catalogId(): int
    {
        self::checkData();
        
        if (isset(self::$data['catalog']['catalogId'])
            && self::$data['catalog']['catalogId'] > 0
        ) {
            return self::$data['catalog']['catalogId'];
        }

        throw new Exception('Ошибка получения catalogId или поле не содержит значение');
    }
    
    /**
     * Получение entityId
     *
     * @return int
     * @throws Exception
     */
    public static function entityId(): int
    {
        self::checkData();
    
        if (isset(self::$data['entity']['entityId'])
            && self::$data['entity']['entityId'] > 0
        ) {
            return self::$data['entity']['entityId'];
        }
    
        throw new Exception('Ошибка получения entityId или поле не содержит значение');
    }
    
    /**
     * Получение entityName
     *
     * @return string
     * @throws Exception
     */
    public static function entityName(): string
    {
        self::checkData();
    
        if (isset(self::$data['entity']['entityName'])
            && self::$data['entity']['entityName']
        ) {
            return self::$data['entity']['entityName'];
        }
    
        throw new Exception('Ошибка получения entityName или поле не содержит значение');
    }
    
    /**
     * Получение attributes
     *
     * @return array
     * @throws Exception
     */
    public static function attributes(): array
    {
        self::checkData();
    
        if (isset(self::$data['attributes'])
            && self::$data['attributes']
        ) {
            return self::$data['attributes'];
        }
    
        throw new Exception('Ошибка получения attributes или поле не содержит значение');
    }
    
    /**
     * Получение attributeId в attributes{}
     *
     * @param array $attribute
     *
     * @return int
     * @throws Exception
     */
    public static function attributeId(array $attribute): int
    {
        self::checkData();
    
        if (isset($attribute['attributeId'])
            && $attribute['attributeId'] > 0
        ) {
            return $attribute['attributeId'];
        }
    
        throw new Exception('Ошибка получения attributeId или поле не содержит значение');
    }
    
    /**
     * Получение typeId в attributes{}
     *
     * @param array $attribute
     *
     * @return int
     * @throws Exception
     */
    public static function typeId(array $attribute): int
    {
        self::checkData();
    
        if (isset($attribute['typeId'])
            && $attribute['typeId'] > 0
        ) {
            return $attribute['typeId'];
        }
    
        throw new Exception('Ошибка получения typeId или поле не содержит значение');
    }
    
    /**
     * Получение typeName в attributes{}
     *
     * @param array $attribute
     *
     * @return string
     * @throws Exception
     */
    public static function typeName(array $attribute): string
    {
        self::checkData();
        
        if (isset($attribute['typeName'])
            && $attribute['typeName']
        ) {
            return$attribute['typeName'];
        }
        
        throw new Exception('Ошибка получения typeName или поле не содержит значение');
    }
    
    /**
     * Получение dictionaryId в attributes{}
     *
     * @param array $attribute
     *
     * @return int
     */
    public static function dictionaryId(array $attribute): int
    {
        return $attribute['dictionaryId'] ?? 0;
    }
    
    /**
     * Получение dictionaryName в attributes{}
     *
     * @param array $attribute
     *
     * @return string
     */
    public static function dictionaryName(array $attribute): string
    {
        return $attribute['dictionaryName'] ?? '';
    }
    
    /**
     * Получение values в attributes{}
     *
     * @param array $attribute
     *
     * @return array
     * @throws Exception
     */
    public static function values(array $attribute): array
    {
        self::checkData();
        
        if (isset($attribute['values'])
            && $attribute['values']
        ) {
            return $attribute['values'];
        }
        
        throw new Exception('Ошибка получения values или поле не содержит значение');
    }
    
    /**
     * @throws Exception
     */
    private static function checkData(): void
    {
        if (!self::$data) {
            throw new Exception('Не определены данные');
        }
    }
    
}
