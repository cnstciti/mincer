<?php declare(strict_types = 1);

namespace modules\domains\modules\catalog\models;

class CatalogForm extends CatalogTable
{
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['parentId', 'containsProducts'/*, 'isDelete'*/], 'integer'],
        ];
    }
    
}
