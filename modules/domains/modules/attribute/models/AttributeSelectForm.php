<?php declare(strict_types=1);

namespace modules\domains\modules\attribute\models;

use yii\base\Model;

/**
 * @property int $attributeId
 */
class AttributeSelectForm extends Model
{
    public $attributeId;
    
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['attributeId'], 'integer'],
            [['attributeId'], 'required'],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'attributeId' => 'Существующий атрибут',
        ];
    }
    
}
