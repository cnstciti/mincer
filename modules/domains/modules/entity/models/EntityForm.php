<?php declare(strict_types=1);

namespace modules\domains\modules\entity\models;

class EntityForm extends EntityTable
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
