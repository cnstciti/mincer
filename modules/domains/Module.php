<?php declare(strict_types=1);

namespace modules\domains;

use Exception;
use Yii;
use yii\base\Module as BaseModule;
use yii\db\Connection;
use yii\db\Transaction;

/**
 * domains module definition class
 */
class Module extends BaseModule
{
    /**
     * {@inheritdoc}
     */
    //public $controllerNamespace = 'modules\domains\controllers';
    

    /**
     * {@inheritdoc}
     * /
    public function init()
    {
        parent::init();

        // custom initialization code goes here
        /*$this->modules = [
            'unit' => [
                // здесь имеет смысл использовать более лаконичное пространство имен
                'class' => 'modules\domains\modules\unit\Module',
            ],
        ];* /
    }
    
    /**
     * @return Connection
     * @throws Exception
     */
    public function getDb(): Connection
    {
        if (!isset($this->params['db'])) {
            throw new Exception("Не определен параметр 'db' модуля " . get_class($this));
        }
        
        return Yii::$app->{$this->params['db']};
    }
    
    /**
     * @return Transaction
     * @throws Exception
     */
    public function beginTransaction(): Transaction
    {
        try {
            return self::getInstance()->getDb()->beginTransaction();
        } catch (Exception $e) {
            throw new Exception("Ошибка старта тарзакции");
        }
    }
    
    /**
     * @return bool
     * @throws Exception
     * /
    public function checkIsExistId(): bool
    {
        if (!isset($this->params['checkIsExistId'])) {
            throw new Exception("Не определен параметр 'checkIsExistId' модуля " . get_class($this));
        }
        
        return $this->params['checkIsExistId'];
    }

    /**
     * @return bool
     * @throws Exception
     * /
    public function importFromExcel(): bool
    {
        if (!isset($this->params['importFromExcel'])) {
            throw new Exception("Не определен параметр 'importFromExcel' модуля " . get_class($this));
        }
        
        return $this->params['importFromExcel'];
    }

    /**
     * @return bool
     * @throws Exception
     * /
    public function accessExtraFunctions(): bool
    {
        if (!isset($this->params['accessExtraFunctions'])) {
            throw new Exception("Не определен параметр 'accessExtraFunctions' модуля " . get_class($this));
        }
        
        return $this->params['accessExtraFunctions'];
    }



    /**
     * @return bool
     * @throws Exception
     * /
    public function editAttributeGroup(): bool
    {
        if (!isset($this->params['editAttributeGroup'])) {
            throw new Exception("Не определен параметр 'editAttributeGroup' модуля " . get_class($this));
        }
        
        return $this->params['editAttributeGroup'];
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function editUnit(): bool
    {
        return $this->getParam('editUnit');
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function editTypeValue(): bool
    {
        return $this->getParam('editTypeValue');
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function editDictionary(): bool
    {
        return $this->getParam('editDictionary');
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function editDictionaryContent(): bool
    {
        return $this->getParam('editDictionaryContent');
    }
    
    /**
     * @return bool
     * @throws Exception
     */
    public function editCatalog(): bool
    {
        return $this->getParam('editCatalog');
    }
    
    /**
     * @return bool
     * @throws Exception
     */
    public function editAttribute(): bool
    {
        return $this->getParam('editAttribute');
    }

    /**
     * @return bool
     * @throws Exception
     * /
    public function showEntityReport(): bool
    {
        if (!isset($this->params['showEntityReport'])) {
            throw new Exception("Не определен параметр 'showEntityReport' модуля " . get_class($this));
        }
        
        return $this->params['showEntityReport'];
    }
*/
    
    /**
     * @param string $paramValue
     *
     * @return bool
     * @throws Exception
     */
    private function getParam(string $paramValue): bool
    {
        if (!isset($this->params[$paramValue])) {
            throw new Exception(
                "Не определен параметр '%s' модуля ",
                $paramValue,
                get_class($this)
            );
        }
    
        return $this->params[$paramValue];
    }

}


