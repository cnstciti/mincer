<?php declare(strict_types = 1);

namespace frontend\models\parser_value;

use Exception;
use Throwable;

class ParserValueService
{
    private const TITLE = 'Парсер. Значения';
    
    
    /**
     * Заголовок
     * @return string
     */
    public function title(): string
    {
        return self::TITLE;
    }
    
    /**
     * Грид
     *
     * @param array  $queryParams
     * @param string $title
     *
     * @return string
     * @throws Throwable
     * /
    public function getGrid(
        array $queryParams,
        string $title
    ): string
    {
        $searchModel = new ParserValueSearch();
        
        return ParserValueGrid::get(
            $searchModel,
            $searchModel->search($queryParams),
            $title,
            intval($queryParams['catalogId'])
        );
    }
    
    /**
     * Модель LinkCatalogForm
     * @param int $entityId
     * @return LinkAttributeForm
     * @throws Exception
     * /
    public function getLinkAttributeForm(int $attributeId = 0): LinkAttributeForm
    {
        $model = $attributeId
            ? LinkAttributeForm::findOne($attributeId)
            : new LinkAttributeForm;
        
        if ( ! $model) {
            throw new Exception(sprintf(
                "Не найдена модель LinkAttributeForm с ИД: %d",
                $attributeId
            ));
        }
        
        return $model;
    }
    
    /**
     * Наименование
     * @param int $id
     * @return string
     * /
    public function name(int $entityId): string
    {
        return ParserEntityTable::findOne($entityId)->name;
    }
    
    /**
     * данные для select2 - продукты каталога, без базового продукта
     * @return array
     * /
    public function products(int $catalogId, int $entityId): array
    {
        $rows = EntityTable::find()
            ->select('e.id, e.name')
            ->from(['e' => EntityTable::tableName()])
            ->leftJoin(['ca' => CatalogEntityTable::tableName()], 'e.id=ca.entityId')
            ->where(['ca.catalogId' => $catalogId])
            ->andWhere('ca.entityId <> ' . $entityId)
            ->all();
    
        $format = function ($row) {
            return sprintf(
                '%s (ИД: %s)',
                $row->name,
                $row->id
            );
        };
        
        return ArrayHelper::map($rows, 'id', $format);
    }
    
    /**
     * сохранение
     *
     * @param int    $catalogId
     * @param string $entityName
     * @throws Exception
     * /
    public function insert(string $entityName, int $isDelete = 0): void
    {
        try {
            $t            = new EntityTable();
            $t->name      = $entityName;
            $t->isDelete  = $isDelete;
            $t->save();
        } catch (Throwable $e) {
            throw new Exception('Ошибка при создании Entity. ' . $e->getMessage());
        }
    }
    
    /**
     * Последний (максимальный) ИД
     *
     * @return int
     * /
    public function lastId(): int
    {
        return EntityTable::lastId();
    }
    
    public function listByCatalog(int $catalogId, int $entityId): array
    {
        return EntityTable::find()
            ->select('e.*')
            ->from(['e' => EntityTable::tableName()])
            ->leftJoin(['ca' => CatalogEntityTable::tableName()], 'e.id=ca.entityId')
            ->where(['ca.catalogId' => $catalogId])
            ->andWhere('ca.entityId <> ' . $entityId)
            ->all();
    }
    */
}
