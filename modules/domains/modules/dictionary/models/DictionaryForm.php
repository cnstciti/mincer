<?php declare(strict_types = 1);

namespace modules\domains\modules\dictionary\models;

class DictionaryForm extends DictionaryTable
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
