<?php declare(strict_types = 1);

namespace modules\domains\modules\attribute\models;

class FullNameParamForm extends FullNameParamTable
{
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sequenceNumber'], 'integer'],
        ];
    }

}
