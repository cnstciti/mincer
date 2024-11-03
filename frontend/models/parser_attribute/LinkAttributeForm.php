<?php declare(strict_types = 1);

namespace frontend\models\parser_attribute;

use frontend\models\tables\ParserAttributeTable;

class LinkAttributeForm extends ParserAttributeTable
{
    
    /**
     * {@inheritdoc}
     * /
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
            [['attributeId'], 'integer'],
            ['status', 'string'],
            ['attributeId', 'default', 'value' => 0],
        ];
    }
    /*
    public function validateOne()
    {
        $entityId     = intval($_POST['LinkEntityForm']['entityId']);
        $isBaseEntity = intval($_POST['LinkEntityForm']['isBaseEntity']);
    
        $msg = 'Выберите или Базовый продукт или Сделать продукт базовым';
        if ( ! $entityId && ! $isBaseEntity) {
            $this->addError('entityId', $msg);
            $this->addError('isBaseEntity', $msg);
        }
        
        if ($entityId && $isBaseEntity) {
            $this->addError('entityId', $msg);
            $this->addError('isBaseEntity', $msg);
        }
    }
*/
}
