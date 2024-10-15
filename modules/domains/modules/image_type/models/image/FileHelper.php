<?php declare(strict_types=1);

namespace modules\domains\modules\image_type\models\image;

class FileHelper
{
    /**
     * Возвращает уникальное имя файла по пути $path с расширением $extension
     *
     * @param string $path
     * @param string $extension
     *
     * @return string
     */
    public static function getRandomFileName(string $path, string $extension): string
    {
        $path      = self::normalizationPath($path);
        $extension = self::normalizationExtension($extension);

        do {
            $name = self::generateRandomString();
            $file = $path . $name . $extension;
        } while (file_exists($file));
    
        return $name;
    }

    /**
     * Генерация рандомного подпути с вложенностью $level, длина каждой подпапки $lenSubPath
     *
     * @param int $level
     * @param int $lenSubPath
     *
     * @return string
     */
    public static function generateRandomSubPath(int $level = 4, int $lenSubPath = 2): string
    {
        $lenStr = $lenSubPath * $level;
        $hash   = self::generateRandomString($lenStr);
        $result = '';

        for ($i=0; $i<$lenStr; $i+=$lenSubPath) {
            $result .= substr($hash, $i, $lenSubPath) . '/';
        }
    
        return trim($result, '/');  // везде нет завершающего слэша, и здесь не будет
    }
    
    /**
     * Генерация рандомной строки длины $length
     *
     * @param int $length
     *
     * @return false|string
     */
    private static function generateRandomString($length = 8) {
        return substr(
                str_shuffle(
                    str_repeat(
                        //$x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
                        $x = '0123456789abcdefghijklmnopqrstuvwxyz',
                        intval(
                            ceil(
                                $length / strlen($x)
                            )
                        )
                    )
                ),
                1,
                $length
        );
    }
    
    /**
     * Возвращает размер файла в байтах или 0, если не удалось вычислить размер
     *
     * @param string $fullFileName
     *
     * @return int
     */
    public static function getSizeFile(string $fullFileName): int
    {
        $sizeFile = filesize($fullFileName);
    
        return $sizeFile ? $sizeFile : 0;
    }
    
    /**
     * Нормализация пути, добавление '/' в конце при необходимости
     *
     * @param string $path
     *
     * @return string
     */
    public static function normalizationPath(string $path): string
    {
        return $path[strlen($path) - 1] === '/' ? $path : $path . '/';
    }
    
    /**
     * Нормализация расширения файла, добавление '.' в начале при необходимости
     *
     * @param string $extension
     *
     * @return string
     */
    public static function normalizationExtension(string $extension): string
    {
        return $extension[0] === '.' ? $extension : '.' . $extension;
    }
    
}
