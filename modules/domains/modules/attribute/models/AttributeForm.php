<?php declare(strict_types=1);

namespace modules\domains\modules\attribute\models;

class AttributeForm extends AttributeTable
{
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'typeValueId'], 'required'],
            [['name', 'description'], 'string', 'max' => 255],
            [[/*'isDelete',*/ 'unitId', 'dictionaryId', 'typeValueId'], 'integer'],
        ];
    }

}
