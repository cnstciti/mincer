<?php declare(strict_types = 1);

namespace frontend\models\parser_simple_type;

use yii\base\Model;

class LinkEnumForm extends Model
{
    public $selectDictionaryContentId;
    
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
