<?php declare(strict_types = 1);

namespace modules\domains\modules\entity\models;

use Exception;
use modules\domains\Module;
use Throwable;

class EntityService
{
    private const TITLE = 'Продукты';
    
    
    /**
     * Заголовок
     * @return string
     */
    public static function getTitle(): string
    {
        return self::TITLE;
    }
    
    /**
     * Грид
     *
     * @param array        $queryParams
     * @param EntitySearch $searchModel
     * @param string       $title
     *
     * @return string
     * @throws Throwable
     */
    public function getGrid(
        EntitySearch $searchModel,
        array $queryParams,
        string $title
    ): string {
        return EntityGrid::get(
            $searchModel,
            $searchModel->search($queryParams),
            $title,
            (int)$queryParams['catalogId']
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
    public static function getForm(EntityForm $form, int $entityId = 0): EntityForm
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
    public static function getName(int $entityId): string
    {
        return EntityTable::findOne($entityId)->name;
    }
    
    /**
     * сохранение
     *
     * @param EntityTable    $t
     * @param string $entityName
     * @param int    $isDelete
     */
    public static function insert(EntityTable $t, string $entityName, int $isDelete = 0): void
    {
        $t->name      = $entityName;
        $t->isDelete  = $isDelete;
        $t->save();
    }
    
    /**
     * Последний (максимальный) ИД
     *
     * @return int
     */
    public static function lastId(): int
    {
        return EntityTable::lastId();
    }
    
    /**
     * очистка
     *
     * @throws \yii\db\Exception
     * @throws Exception
     */
    public static function truncate()
    {
        Module::getInstance()
              ->getDb()
              ->createCommand()
              ->truncateTable(EntityTable::tableName())
              ->execute();
    }
    
}
