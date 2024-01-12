<?php declare(strict_types = 1);

namespace modules\domains\modules\import\models;

use Exception;
use modules\domains\Module as DomainsModule;
use modules\domains\modules\attribute\models\CatalogAttributeService;
use modules\domains\modules\value\models\EavService;
use Throwable;
use Yii;

class ImportService
{
    private const TITLE = 'Импорт';
   
    
    /**
     * Заголовок
     * @return string
     */
    public static function getTitle(): string
    {
        return self::TITLE;
    }
    
    /**
     * Форма выбора файла
     *
     * @param ImportForm $form
     *
     * @return ImportForm
     */
    public static function getImportForm(ImportForm $form): ImportForm
    {
        return $form;
    }
    
    /**
     * Импорт из json-файла
     *
     * @param string $file
     * @param int $isTruncate
     * @return void
     * @throws \yii\db\Exception
     */
    public static function fromJson(string $file, int $isTruncate): void
    {
        $data = ImportReadData::openFile($file);

        if ($isTruncate) {
            ImportCleanupData::truncate();
        }
    
        ImportGetData::$data = $data;

        try {
            $transaction = DomainsModule::getInstance()->beginTransaction();

            $catalogId       = ImportGetData::catalogId();
            $entityId        = ImportSaveData::saveEntity();
            $catalogEntityId = ImportSaveData::saveCatalogEntity($catalogId, $entityId);

            foreach (ImportGetData::attributes() as $attribute) {
                $catalogAttributeId = self::getCatalogAttribute($catalogId, $attribute);
            
                foreach (ImportGetData::values($attribute) as $value) {
                    if ($valueId = ImportSaveData::saveValue($attribute, $value)) {
                        self::insertEav($catalogEntityId, $catalogAttributeId, $valueId);
                    }
                }
            }
        
            $transaction->commit();
        } catch (Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }
    }
    
    /**
     * @param int   $catalogId
     * @param array $attribute
     *
     * @return int
     * @throws Exception
     */
    private static function getCatalogAttribute(int $catalogId, array $attribute): int
    {
        $attributeId        = ImportGetData::attributeId($attribute);
        $catalogAttributeId = CatalogAttributeService::getId($attributeId, $catalogId);
        
        if ( ! $catalogAttributeId) {
            throw new Exception(sprintf(
                'Ошибка получения связи Каталог-Атрибут. catalogId: %d, attributeId: %d',
                $catalogId,
                $attributeId
            ));
        }
        
        return $catalogAttributeId;
    }

    private static function insertEav(
        int $catalogEntityId,
        int $catalogAttributeId,
        int $valueId
    ): void
    {
        try {
            Yii::$container->invoke(
                [
                    new EavService,
                    'insert',
                ],
                [
                    'catalogEntityId' => $catalogEntityId,
                    'catalogAttributeId' => $catalogAttributeId,
                    'valueId' => $valueId,
                ]
            );
        } catch (Throwable $e) {
            throw new Exception(sprintf(
                'Ошибка вызова EavService->insert: %s',
                $e->getMessage()
            ));
        }
    }

}
