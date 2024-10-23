<?php declare(strict_types = 1);

namespace console\models;

use frontend\models\tables\ParserAttributeTable;
use frontend\models\tables\ParserEntityAttributeTable;
use frontend\models\tables\ParserEntityTable;
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
     * @throws \yii\db\Exception
     */
    protected function truncateTables(): void
    {
        echo 'Очистка таблиц парсера.' . PHP_EOL;
        Yii::$app->db->createCommand()->truncateTable(ParserEntityTable::tableName())->execute();
        Yii::$app->db->createCommand()->truncateTable(ParserAttributeTable::tableName())->execute();
        Yii::$app->db->createCommand()->truncateTable(ParserEntityAttributeTable::tableName())->execute();
    }
    
    protected function createEntity(string $name): int
    {
        try {
            $t               = new ParserEntityTable;
            $t->name         = $name;
            $t->parserSiteId = $this->parserSiteId();
            $t->save();
        } catch (Throwable $e) {
            echo sprintf('Ошибка создания продукта: %s. Продукт: %s.%s',
                $e->getMessage(),
                $name,
                PHP_EOL
            );
        }
        
        return intval(Yii::$app->db->getLastInsertID());
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
                ->where(['parserEntityId'    => $entityId,
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
    
}
