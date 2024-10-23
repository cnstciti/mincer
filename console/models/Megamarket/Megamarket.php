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
            $name = trim($document->first('.pdp-header__title_only-title')->text());
            
            // создаем Продукт
            $entityId = $this->createEntity($name);
            echo 'Продукт: ' . $name . PHP_EOL;
            echo 'Продукт ИД: ' . $entityId . PHP_EOL;

            // берем Описание продукта
            $desc = trim($document->first('.cut-block__text-inner .text-block')->text());
            //echo 'Описание продукта: ' . $desc . PHP_EOL;

            // создаем атрибут "Описание"
            $attributeId = $this->createAttribute('Описание');
            echo 'Атрибут: Описание' . PHP_EOL;
            echo 'Атрибут ИД: ' . $attributeId . PHP_EOL;
            
            // создаем связь Продукт - Атрибут
            $entityAttributeId = $this->createEntityAttributeLink($entityId, $attributeId);
            echo 'Связь (Продукт - Атрибут) ИД: ' . $entityAttributeId . PHP_EOL;
            
            
            $av = [];
            $groups = $document->find('.pdp-specs__group-info');
            foreach ($groups as $group) {
                $items = $group->find('.pdp-specs__item');
                foreach ($items as $item) {
                    if ($itemName = $item->first('.pdp-specs__item-name')) {
                        $itemName = trim($itemName->text());
                        $attributeId = $this->createAttribute($itemName);
                        echo 'Атрибут: ' . $itemName . PHP_EOL;
                        echo 'Атрибут ИД: ' . $attributeId . PHP_EOL;
                        $entityAttributeId = $this->createEntityAttributeLink($entityId, $attributeId);
                        echo 'Связь (Продукт - Атрибут) ИД: ' . $entityAttributeId . PHP_EOL;
                    }
                    if ($itemValue = $item->first('.pdp-specs__item-value')) {
                        $itemValue = trim($itemValue->text());
                    }
                    
                    if ($itemName && $itemValue) {
                        $av[] = [
                            'attr' => $itemName,
                            'value' => $itemValue,
                        ];
                    }
                }
            }
            
            //print_r($av);
    
            echo '------------' . PHP_EOL;
    
        }

    }
    
    
}
