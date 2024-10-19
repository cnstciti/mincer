<?php declare(strict_types = 1);

namespace frontend\models\parser_entity;

use frontend\models\tables\ParserEntityTable;

/**
 * @property int $isBaseEntity
 */
class LinkEntityForm extends ParserEntityTable
{
    public int $isBaseEntity;
    
    
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        
        $this->isBaseEntity = intval($this->entityId) ? 0 : 1;
        
        if (isset($_POST['LinkEntityForm']['entityId'])) {
            $this->entityId = $_POST['LinkEntityForm']['entityId'];
        }
        
        if (isset($_POST['LinkEntityForm']['isBaseEntity'])) {
            $this->isBaseEntity = intval($_POST['LinkEntityForm']['isBaseEntity']) ? 1 : 0;
        }
    }
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['entityId', 'isBaseEntity'], 'integer'],
            ['entityId', 'validateOne'],
            ['isBaseEntity', 'validateOne'],
        ];
    }
    
    public function validateOne()
    {
        $entityId     = intval($_POST['LinkEntityForm']['entityId']);
        $isBaseEntity = intval($_POST['LinkEntityForm']['isBaseEntity']);
        
        if ( ! $entityId && ! $isBaseEntity) {
            $msg = 'Необходимо выбрать один из вариантов';
            $this->addError('entityId', $msg);
            $this->addError('isBaseEntity', $msg);
        }
        
        if ($entityId && $isBaseEntity) {
            $msg = 'Выберите только один вариант';
            $this->addError('entityId', $msg);
            $this->addError('isBaseEntity', $msg);
        }
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'entityId'     => 'Базовый продукт',
            'isBaseEntity' => 'Сделать продукт базовым?',
        ];
    }
    
}
