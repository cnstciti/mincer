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
        $this->truncateTables();
        
        
        // Путь к файлам для парсера
        $path = Yii::getAlias('@parserMegamarket') . '/akkumulyatory-dlya-motociklov';
        echo 'Путь к файлам для парсера: ' . $path . PHP_EOL;
        
        // получаем все файлы в корне "пути"
        $allFiles = FileHelper::findFiles($path, ['only'=>['*.html'], 'recursive' => false]);
        
        //print_r($allFiles);
        foreach ($allFiles as $file) {
            $document = new Document($file, true);
    
            // берем Имя продукта
            //$name = trim($document->first('.pdp-header__title_only-title')->text());
            $name = $this->getDOMElement($document, '.pdp-header__title_only-title');
            
            // создаем Продукт
            $entityId = $this->createEntity($name, self::PARSER_SITE_ID);
            echo 'Продукт: ' . $name . PHP_EOL;
            echo 'Продукт ИД: ' . $entityId . PHP_EOL;

            
            $attributeName = 'Описание';
            //$attributeValue = trim($document->first('.cut-block__text-inner .text-block')->text());
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
                    /*
                    $attributeName = $item->first('.pdp-specs__item-name');
                    $attributeName = trim($attributeName->text());
                    $attributeValue = $item->first('.pdp-specs__item-value');
                    $attributeValue = trim($attributeValue->text());
                    */
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
            
            //print_r($av);
    
            echo '------------' . PHP_EOL;
    
        }

    }
    
    
}
