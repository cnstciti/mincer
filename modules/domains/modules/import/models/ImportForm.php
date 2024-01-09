<?php declare(strict_types = 1);

namespace modules\domains\modules\import\models;

use yii\base\Model;
use yii\web\UploadedFile;

class ImportForm extends Model
{
    
    /**
     * @var UploadedFile file attribute
     */
    public $file;
    
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'json'],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'file' => 'Файл импорта',
        ];
    }
    
}
