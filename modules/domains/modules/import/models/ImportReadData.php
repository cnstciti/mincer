<?php declare(strict_types = 1);

namespace modules\domains\modules\import\models;

use Exception;
use Throwable;
use yii\helpers\Json;

class ImportReadData
{
    
    /**
     * Чтение json-файла и возврат в виде ассоциированного масива
     *
     * @param string $file
     *
     * @return array
     * @throws Exception
     */
    public static function openFile(string $file): array
    {
        try {
            return Json::decode(file_get_contents($file));
        } catch (Throwable $e) {
            throw new Exception(sprintf(
                'Ошибка чтения файла: %s. %s',
                $file,
                $e->getMessage()
            ));
        }
    }
    
}
