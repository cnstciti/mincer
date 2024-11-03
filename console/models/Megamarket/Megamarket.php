<?php declare(strict_types=1);

namespace console\models\Megamarket;

use console\models\BaseParser;
use DiDom\Document;
use Yii;
use yii\helpers\FileHelper;

class Megamarket extends BaseParser
{
    private const PARSER_SITE_ID = 1;
    
    protected function parserSiteId(): int
    {
        return self::PARSER_SITE_ID;
    }
    
    /**
     * @throws \DiDom\Exceptions\InvalidSelectorException
     * @throws \yii\db\Exception
     */
    protected function runParser(): void
    {
        // Это для теста! Потом убрать
        //$this->truncateTables();
        
        // Путь к файлам для парсера
        $path = Yii::getAlias('@parserMegamarket') . '/akkumulyatory-dlya-motociklov';
        echo 'Путь к файлам для парсера: ' . $path . PHP_EOL;
        
        // получаем все файлы в корне "пути"
        $allFiles = FileHelper::findFiles($path, ['only'=>['*.html'], 'recursive' => false]);
        
        foreach ($allFiles as $file) {
            $document = new Document($file, true);
    
            // берем Имя продукта
            $name = $this->getDOMElement($document, '.pdp-header__title_only-title');
    
            // создаем Продукт
            $entityId = $this->createEntity($name, self::PARSER_SITE_ID);
            echo 'Продукт: ' . $name . PHP_EOL;
            echo 'Продукт ИД: ' . $entityId . PHP_EOL;
    
            $attributeName = 'Изображения';
    
            // создаем атрибут
            $attributeId = $this->createAttribute($attributeName);
            echo 'Атрибут: '  . $attributeName . PHP_EOL;
            echo 'Атрибут ИД: ' . $attributeId . PHP_EOL;
    
            // создаем связь Продукт - Атрибут
            $entityAttributeId = $this->createEntityAttributeLink($entityId, $attributeId);
            echo 'Связь (Продукт - Атрибут) ИД: ' . $entityAttributeId . PHP_EOL;
            
            $images = $document->find('.gallery-thumbnail.gallery__thumb');
            if ($images) {
                foreach ($images as $image) {
                    $img      = $image->first('img::attr(src)');
                    $info     = pathinfo($img);
                    $folder   = trim($info['dirname'], '.');
                    $pathFile = Yii::getAlias('@parserMegamarket')
                                . '/akkumulyatory-dlya-motociklov'
                                . $folder
                                . '/'
                                . $info['basename'];
        
                    $valueImageId = $this->createImage($info, $pathFile);
                    $eavId        = $this->createEAV($entityAttributeId, $valueImageId);
                    echo 'Изображение: ' . $info['basename'] . PHP_EOL;
                    echo 'Изображение ИД: ' . $valueImageId . PHP_EOL;
                    echo 'Связь (Продукт - Атрибут - Значение) ИД: ' . $eavId . PHP_EOL;
                }
            } else {
                // для одиночного изображения
                $images = $document->find('.inner-image-zoom');
                foreach ($images as $image) {
                    $img      = $image->first('img::attr(src)');
                    $info     = pathinfo($img);
                    $folder   = trim($info['dirname'], '.');
                    $pathFile = Yii::getAlias('@parserMegamarket')
                                . '/akkumulyatory-dlya-motociklov'
                                . $folder
                                . '/'
                                . $info['basename'];
        
                    $valueImageId = $this->createImage($info, $pathFile);
                    $eavId        = $this->createEAV($entityAttributeId, $valueImageId);
                    echo 'Изображение: ' . $info['basename'] . PHP_EOL;
                    echo 'Изображение ИД: ' . $valueImageId . PHP_EOL;
                    echo 'Связь (Продукт - Атрибут - Значение) ИД: ' . $eavId . PHP_EOL;
                }
            }
            
            $attributeName = 'Описание';
            $attributeValue = $this->getDOMElement($document, '.cut-block__text-inner .text-block');
            
            if ($attributeName && $attributeValue) {
                // создаем атрибут
                $attributeId = $this->createAttribute($attributeName);
                echo 'Атрибут: '  . $attributeName . PHP_EOL;
                echo 'Атрибут ИД: ' . $attributeId . PHP_EOL;
    
                // создаем связь Продукт - Атрибут
                $entityAttributeId = $this->createEntityAttributeLink($entityId, $attributeId);
                echo 'Связь (Продукт - Атрибут) ИД: ' . $entityAttributeId . PHP_EOL;
    
                // создаем Значение
                $valueId = $this->createValue($attributeValue);
                echo 'Значение: ' . $attributeValue . PHP_EOL;
                echo 'Значение ИД: ' . $valueId . PHP_EOL;
    
                // создаем связь Продукт - Атрибут - Значение
                $eavId = $this->createEAV($entityAttributeId, $valueId);
                echo 'Связь (Продукт - Атрибут - Значение) ИД: ' . $eavId . PHP_EOL;
            }
            
            $groups = $document->find('.pdp-specs__group-info');
            foreach ($groups as $group) {
                $items = $group->find('.pdp-specs__item');
                foreach ($items as $item) {
                    $attributeName = $this->getDOMElement($item, '.pdp-specs__item-name');
                    $attributeValue = $this->getDOMElement($item, '.pdp-specs__item-value');
                    
                    if ($attributeName && $attributeValue) {
                        // создаем атрибут
                        $attributeId = $this->createAttribute($attributeName);
                        echo 'Атрибут: '  . $attributeName . PHP_EOL;
                        echo 'Атрибут ИД: ' . $attributeId . PHP_EOL;
    
                        // создаем связь Продукт - Атрибут
                        $entityAttributeId = $this->createEntityAttributeLink($entityId, $attributeId);
                        echo 'Связь (Продукт - Атрибут) ИД: ' . $entityAttributeId . PHP_EOL;
    
                        // создаем Значение
                        $valueId = $this->createValue($attributeValue);
                        echo 'Значение: ' . $attributeValue . PHP_EOL;
                        echo 'Значение ИД: ' . $valueId . PHP_EOL;
    
                        // создаем связь Продукт - Атрибут - Значение
                        $eavId = $this->createEAV($entityAttributeId, $valueId);
                        echo 'Связь (Продукт - Атрибут - Значение) ИД: ' . $eavId . PHP_EOL;
                    }
                }
            }
            
            FileHelper::unlink($file);
            FileHelper::removeDirectory(trim($file, '.html') . '_files');
            echo '------------' . PHP_EOL;
            
        }

    }
    
    
}
