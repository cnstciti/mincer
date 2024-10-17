<?php

namespace console\models\Megamarket;

use DiDom\Document;
use frontend\models\tables\ParserEntityTable;
use Throwable;
use Yii;
use yii\helpers\FileHelper;

class Megamarket
{
    private const PARSER_SITE_ID = 1;

    
    public function run()
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $path = Yii::getAlias('@parserMegamarket') . '/akkumulyatory-dlya-motociklov';
            echo 'path: ' . $path . PHP_EOL;
            
            $allFiles = FileHelper::findFiles($path,['only'=>['*.html'], 'recursive' => false]);
            
            //print_r($allFiles);
            foreach ($allFiles as $file) {
                $document = new Document($file, true);
        
                $name = trim($document->first('.pdp-header__title_only-title')->text());
                echo 'name: ' . $name . PHP_EOL;
                $t = new ParserEntityTable;
                $t->name = $name;
                $t->parserSiteId = self::PARSER_SITE_ID;
                $t->save();
        
                $desc = trim($document->first('.cut-block__text-inner .text-block')->text());
                //echo 'desc: ' . $desc . PHP_EOL;
        
                $av = [];
                $groups = $document->find('.pdp-specs__group-info');
                foreach ($groups as $group) {
                    $items = $group->find('.pdp-specs__item');
                    foreach ($items as $item) {
                        if ($itemName = $item->first('.pdp-specs__item-name')) {
                            $itemName = trim($itemName->text());
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
                
                print_r($av);
        
                echo '------------' . PHP_EOL;
        
            }
    
            $transaction->commit();
        } catch (Throwable $e) {
            $transaction->rollBack();
            echo 'Ошибка: ' . $e->getMessage() . PHP_EOL;
        }
    }
    
    
}
