<?php declare(strict_types=1);

namespace modules\domains\modules\type_value\models;

class TypeValueForm extends TypeValueTable
{
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            //[['isDelete'], 'integer'],
        ];
    }

}
