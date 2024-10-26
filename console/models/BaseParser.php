<?php declare(strict_types = 1);

namespace console\models;

use DiDom\Document;
use Exception;
use frontend\models\tables\ParserAttributeTable;
use frontend\models\tables\ParserEAVTable;
use frontend\models\tables\ParserEntityAttributeTable;
use frontend\models\tables\ParserEntityTable;
use frontend\models\tables\ParserValueTable;
use Throwable;
use Yii;

abstract class BaseParser
{
    abstract protected function runParser(): void;
    
    abstract protected function parserSiteId(): int;
    
    public function run()
    {
        echo 'Начало парсера.' . PHP_EOL;
        
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $this->runParser();
            
            $transaction->commit();
        } catch (Throwable $e) {
            $transaction->rollBack();
            echo 'Ошибка: ' . $e->getMessage() . PHP_EOL;
        }
        
        echo 'Окончание парсера.' . PHP_EOL;
    }
    
    /**
     * @param  $document
     * @param string   $mask
     * @return string
     */
    protected function getDOMElement($document, string $mask): string
    {
        try {
            return trim($document->first($mask)->text());
        } catch (Throwable $e) {
            return '';
            /*
            throw new Exception(sprintf('Ошибка получения лемента: %s. Маска: %s.%s',
                $e->getMessage(),
                $mask,
                PHP_EOL
            ));*/
        }
    }
    
    /**
     * @throws \yii\db\Exception
     */
    protected function truncateTables(): void
    {
        echo 'Очистка таблиц парсера.' . PHP_EOL;
        Yii::$app->db->createCommand()->truncateTable(ParserEntityTable::tableName())->execute();
        Yii::$app->db->createCommand()->truncateTable(ParserAttributeTable::tableName())->execute();
        Yii::$app->db->createCommand()->truncateTable(ParserEntityAttributeTable::tableName())->execute();
        Yii::$app->db->createCommand()->truncateTable(ParserValueTable::tableName())->execute();
        Yii::$app->db->createCommand()->truncateTable(ParserEAVTable::tableName())->execute();
    }
    
    protected function createEntity(string $name, int $siteId): int
    {
        try {
            // проверяем, есть ли продукт в таблице
            $entityId = ParserEntityTable::find()
                   ->select('id')
                   ->where(['name' => $name, 'parserSiteId' => $siteId])
                   ->scalar();
        
            if ( ! $entityId) {
                // если НЕ нашли продукт (в свзи с сайтом) в таблице, то создаем его
                $t               = new ParserEntityTable;
                $t->name         = $name;
                $t->parserSiteId = $this->parserSiteId();
                $t->save();
                // берем ИД продукта
                $attributeId = Yii::$app->db->getLastInsertID();
            }
        } catch (Throwable $e) {
            echo sprintf('Ошибка создания продукта: %s. Продукт: %s.%s',
                $e->getMessage(),
                $name,
                PHP_EOL
            );
        }
    
        return intval($attributeId);
    }
    
    protected function createAttribute(string $name): int
    {
        try {
            // проверяем, есть ли атрибут в таблице
            $attributeId = ParserAttributeTable::find()
                ->select('id')
                ->where(['name' => $name])
                ->scalar();
            
            if ( ! $attributeId) {
                // если НЕ нашли атрибут в таблице, то создаем его
                $t       = new ParserAttributeTable;
                $t->name = $name;
                $t->save();
                // берем ИД атрибута
                $attributeId = Yii::$app->db->getLastInsertID();
            }
        } catch (Throwable $e) {
            echo sprintf('Ошибка создания атрибута: %s. Атрибут: %s.%s',
                $e->getMessage(),
                $name,
                PHP_EOL
            );
        }
        
        return intval($attributeId);
    }
    
    protected function createEntityAttributeLink(int $entityId, int $attributeId): int
    {
        try {
            // проверяем, есть ли связь
            $entityAttributeId = ParserEntityAttributeTable::find()
               ->select('id')
               ->where([
                   'parserEntityId'    => $entityId,
                   'parserAttributeId' => $attributeId,
               ])
               ->scalar();
            
            if ( ! $entityAttributeId) {
                // если не нашли связь, то создаем её
                $t                    = new ParserEntityAttributeTable;
                $t->parserEntityId    = $entityId;
                $t->parserAttributeId = $attributeId;
                $t->save();
                // берем ИД связи
                $entityAttributeId = Yii::$app->db->getLastInsertID();
            }
        } catch (Throwable $e) {
            echo sprintf(
                'Ошибка создания связи Продукт - Атрибут: %s. ИД Продукта: %d. ИД атрибута: %d.%s',
                $e->getMessage(),
                $entityId,
                $attributeId,
                PHP_EOL
            );
        }
        
        return intval($entityAttributeId);
    }
    
    protected function createValue(string $meaning): int
    {
        try {
            // проверяем, есть ли значение в таблице
            $valueId = ParserValueTable::find()
               ->select('id')
               ->where(['meaning' => $meaning])
               ->scalar();
            
            if ( ! $valueId) {
                // если НЕ нашли значение в таблице, то создаем его
                $t          = new ParserValueTable;
                $t->meaning = $meaning;
                $t->save();
                // берем ИД атрибута
                $valueId = Yii::$app->db->getLastInsertID();
            }
        } catch (Throwable $e) {
            echo sprintf('Ошибка создания значения: %s. Значение: %s.%s',
                $e->getMessage(),
                $meaning,
                PHP_EOL
            );
        }
        
        return intval($valueId);
    }

    protected function createEAV(int $entityAttributeId, int $valueId): int
    {
        try {
            // проверяем, есть ли связь
            $eavId = ParserEAVTable::find()
                   ->select('id')
                   ->where([
                       'entityAttributeId' => $entityAttributeId,
                       'valueId'           => $valueId,
                   ])
                   ->scalar();
            
            if ( ! $eavId) {
                // если не нашли связь, то создаем её
                $t                    = new ParserEAVTable;
                $t->entityAttributeId = $entityAttributeId;
                $t->valueId           = $valueId;
                $t->save();
                // берем ИД связи
                $entityAttributeId = Yii::$app->db->getLastInsertID();
            }
        } catch (Throwable $e) {
            echo sprintf(
                'Ошибка создания связи Продукт - Атрибут - Значение: %s. ИД Продукт - Атрибут: %d. ИД значения: %d.%s',
                $e->getMessage(),
                $entityAttributeId,
                $valueId,
                PHP_EOL
            );
        }
        
        return intval($entityAttributeId);
    }
    
}
