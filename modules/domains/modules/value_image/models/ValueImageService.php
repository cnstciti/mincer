<?php declare(strict_types = 1);

namespace modules\domains\modules\value_image\models;

use modules\domains\modules\image_type\models\ImageTypeDataView;
use modules\domains\modules\values\models\IValueService;

class ValueImageService implements IValueService
{
    
    /**
     * Получение модели
     *
     * @param int $id
     * @return ValueImageTable
     */
    public function getModel(int $id=0): ValueImageTable
    {
        return ValueImageTable::findOne($id) ?? new ValueImageTable;
    }
    
    public function getForDemo(int $entityId, int $catalogId): array
    {
        return ImageTypeDataView::find()
                              ->where([
                                  'entityId' => $entityId,
                                  'catalogId' => $catalogId,
                                  'type' => 'card',
                              ])
                              ->all();
        /*
        "
        select d1.name as original, d2.name as thumb
        from (
            select ep.sequenceNumber, p.name
            from picture p
            left join entity_picture ep on ep.idPicture = p.id
            where ep.idEntity = :idEntity
              and p.type = :original
              and p.isDelete=0 and p.isVisible=1
        ) d1,
        (
            select ep.sequenceNumber, p.name
            from picture p
            left join entity_picture ep on ep.idPicture = p.id
            where ep.idEntity = :idEntity
              and p.type = :thumb
              and p.isDelete=0 and p.isVisible=1
        ) d2
        where d1.sequenceNumber = d2.sequenceNumber
        order by d1.sequenceNumber
    ";
    
    return self::getDb()->createCommand($query)
               ->bindValue(':idEntity', $idEntity)
               ->bindValue(':original', self::TYPE_CARD_ORIGINAL)
               ->bindValue(':thumb', self::TYPE_CARD_THUMB)
               ->queryAll();*/
    }
    
}
