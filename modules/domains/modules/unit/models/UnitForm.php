<?php declare(strict_types=1);

namespace modules\domains\modules\unit\models;

class UnitForm extends UnitTable
{
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'shortName'], 'required'],
            [['name', 'shortName'], 'string', 'max' => 255],
            //[['isDelete'], 'integer'],
        ];
    }

}
