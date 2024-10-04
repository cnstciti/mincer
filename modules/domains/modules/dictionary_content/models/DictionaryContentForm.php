<?php declare(strict_types = 1);

namespace modules\domains\modules\dictionary_content\models;

class DictionaryContentForm extends DictionaryContentTable
{
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['value'], 'required'],
            [['value'], 'string', 'max' => 255],
            //[['isDelete'], 'integer'],
        ];
    }
    
}
