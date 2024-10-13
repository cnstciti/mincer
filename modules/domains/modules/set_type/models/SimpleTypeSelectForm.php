<?php declare(strict_types = 1);

namespace modules\domains\modules\simple_type\models;

use yii\base\Model;

class SimpleTypeSelectForm extends Model
{
    public $selectEntity;
    
    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['selectEntity'], 'required'],
        ];
    }

}
