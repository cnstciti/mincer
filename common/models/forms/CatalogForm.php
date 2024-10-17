<?php declare(strict_types = 1);

namespace common\models\forms;

use common\models\tables\CatalogTable;

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
            [['parentId', 'containsProducts'], 'integer'],
        ];
    }
    
}
