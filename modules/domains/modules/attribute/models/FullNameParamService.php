<?php declare(strict_types = 1);

namespace modules\domains\modules\attribute\models;

use Exception;
use yii\helpers\ArrayHelper;

class FullNameParamService
{
    
    /**
     * Форма для редактирования
     *
     * @param FullNameParamForm $form
     * @param int               $catalogAttributeId
     *
     * @return FullNameParamForm
     */
    public static function getForm(
        FullNameParamForm $form,
        int $catalogAttributeId = 0
    ): FullNameParamForm {
        $f = $form::findOne($catalogAttributeId);
        
        if ( ! $f) {
            $form->id = 0;
            return $form;
        }
        
        return $f;
    }
    
    /**
     * сохранение
     *
     * @param FullNameParamTable $t
     * @param int $catalogAttributeId
     * @param int $sequenceNumber
     */
    public static function insert(
        FullNameParamTable $t,
        int $catalogAttributeId,
        int $sequenceNumber
    ): void {
        $t->id             = $catalogAttributeId;
        $t->sequenceNumber = $sequenceNumber;
        $t->save();
    }
    
    /**
     * обновление
     *
     * @param int $fullNameParamId
     * @param int $sequenceNumber
     */
    public static function update(
        int $fullNameParamId,
        int $sequenceNumber
    ): void {
        $t                 = FullNameParamTable::findOne($fullNameParamId);
        $t->sequenceNumber = $sequenceNumber;
        $t->save();
    }
    
    /**
     * удаление
     *
     * @param int $fullNameParamId
     */
    public static function delete(int $fullNameParamId): void
    {
        FullNameParamTable::deleteAll(['id' => $fullNameParamId]);
    }

    /**
     * Порядковый номер
     *
     * @param int $catalogAttributeId
     *
     * @return int
     */
    public static function getSequenceNumber(int $catalogAttributeId): int
    {
        $row = FullNameParamTable::findOne($catalogAttributeId);
        
        return $row ? $row->sequenceNumber : 0;
    }
    
}
