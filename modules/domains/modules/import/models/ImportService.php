<?php declare(strict_types = 1);

namespace modules\domains\modules\import\models;

use Exception;
use modules\domains\Module as DomainsModule;
use modules\domains\modules\attribute\models\CatalogAttributeService;
use modules\domains\modules\entity\models\CatalogEntityService;
use modules\domains\modules\value\models\EavService;
use Throwable;

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
     *
     * @throws Throwable
     */
    public static function fromJson(string $file)
    {
        $data = ImportReadData::openFile($file);
    
        //ImportCleanupData::truncate();
    
        ImportGetData::$data = $data;
    
        //try {
        //    $transaction = DomainsModule::getInstance()->beginTransaction();

            $catalogId       = ImportGetData::catalogId();
            $entityId        = ImportSaveData::saveEntity();
            $catalogEntityId = ImportSaveData::saveCatalogEntity($catalogId, $entityId);

            foreach (ImportGetData::attributes() as $attribute) {
                $catalogAttributeId = self::getCatalogAttribute($catalogId, $attribute);
            
                foreach (ImportGetData::values($attribute) as $value) {
                    if ($valueId = ImportSaveData::saveValue($attribute, $value)) {
                        EavService::insert($catalogEntityId, $catalogAttributeId, $valueId);
                    }
                }
            }
        
        //    $transaction->commit();
        //} catch (Throwable $e) {
        //    $transaction->rollBack();
        //    throw $e;
        //}
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
    
}
