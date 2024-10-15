<?php declare(strict_types = 1);

namespace modules\domains\modules\type_value\models;

use Exception;
use Throwable;
use yii\helpers\ArrayHelper;

class TypeValueService
{
    public const FLOAT = 'float';
    public const INT = 'int';
    public const STRING = 'string';
    public const TEXT = 'text';
    public const ENUM = 'enum';
    public const SET = 'set';
    
    private const TITLE = 'Типы значений';
    
    
    /**
     * Заголовок
     *
     * @return string
     */
    public function getTitle(): string
    {
        return self::TITLE;
    }
    
    /**
     * Грид
     *
     * @param TypeValueSearch $searchModel
     * @param array           $queryParams
     * @param bool            $isEdit
     *
     * @return string
     * @throws Throwable
     */
    public function getGrid(
        TypeValueSearch $searchModel,
        array $queryParams,
        bool $isEdit
    ): string
    {
        return TypeValueGrid::get(
            $searchModel,
            $searchModel->search($queryParams),
            self::getTitle(),
            $isEdit
        );
    }
    
    /**
     * Форма
     *
     * @param TypeValueForm $form
     * @param int           $typeValueId
     *
     * @return TypeValueForm
     * @throws Exception
     */
    public function getForm(TypeValueForm $form, int $typeValueId = 0): TypeValueForm
    {
        $form = $typeValueId ? $form::findOne($typeValueId) : $form;
        
        if ( ! $form) {
            throw new Exception(sprintf(
                "Не найдена модель TypeValueForm с ИД: %d",
                $typeValueId
            ));
        }
        
        return $form;
    }
    
    /**
     * данные для select2
     *
     * @return array
     */
    public function dataForSelect2(): array
    {
        return ArrayHelper::map(
            //TypeValueTable::findAll([/*'isDelete' => 0*/]),
            TypeValueTable::find()->all(),
            'id',
            'name'
        );
    }

}
