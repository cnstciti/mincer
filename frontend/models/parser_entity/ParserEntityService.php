<?php declare(strict_types = 1);

namespace frontend\models\parser_entity;

use Exception;
use modules\domains\modules\catalog_entity\models\CatalogEntityTable;
use Throwable;

class ParserEntityService
{
    private const TITLE = 'Продукты';
    
    
    /**
     * Заголовок
     * @return string
     */
    public function getTitle(): string
    {
        return self::TITLE;
    }
    
    /**
     * Грид
     *
     * @param array        $queryParams
     * @param ParserEntitySearch $searchModel
     * @param string       $title
     *
     * @return string
     * @throws Throwable
     */
    public function getGrid(
        ParserEntitySearch $searchModel,
        array $queryParams,
        string $title
    ): string
    {
        return ParserEntityGrid::get(
            $searchModel,
            $searchModel->search($queryParams),
            $title//,
            //(int)$queryParams['catalogId']
        );
    }
    
    /**
     * Форма для редактирования
     *
     * @param EntityForm $form
     * @param int        $entityId
     *
     * @return EntityForm
     * @throws Exception
     */
    public function getForm(EntityForm $form, int $entityId = 0): EntityForm
    {
        $form = $entityId ? $form::findOne($entityId) : $form;
        
        if ( ! $form) {
            throw new Exception(sprintf(
                "Не найдена модель EntityForm с ИД: %d",
                $entityId
            ));
        }
        
        return $form;
    }
    
    /**
     * Наименование
     *
     * @param int $entityId
     *
     * @return string
     */
    public function getName(int $entityId): string
    {
        return EntityTable::findOne($entityId)->name;
    }
    
    /**
     * сохранение
     *
     * @param int    $catalogId
     * @param string $entityName
     * @throws Exception
     */
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
     */
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
    
}
