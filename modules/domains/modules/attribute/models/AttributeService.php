<?php declare(strict_types = 1);

namespace modules\domains\modules\attribute\models;

use Exception;
use Throwable;
use yii\helpers\ArrayHelper;

class AttributeService
{
    private const TITLE = 'Атрибуты';
    
    
    /**
     * Заголовок
     *
     * @return string
     */
    public static function getTitle(): string
    {
        return self::TITLE;
    }
    
    /**
     * Грид
     *
     * @param AttributeSearch $searchModel
     * @param array           $queryParams
     * @param bool            $isEdit
     * @param string          $title
     *
     * @return string
     * @throws Throwable
     */
    public function getGrid(
        AttributeSearch $searchModel,
        array $queryParams,
        bool $isEdit,
        string $title
    ): string {
        return AttributeGrid::get(
            $searchModel,
            $searchModel->search($queryParams),
            $title,
            $isEdit,
            (int)$queryParams['catalogId']
        );
    }
    
    /**
     * Форма для редактирования
     *
     * @param AttributeForm $form
     * @param int           $attributeId
     *
     * @return AttributeForm
     * @throws Exception
     */
    public static function getForm(AttributeForm $form, int $attributeId = 0): AttributeForm
    {
        $form = $attributeId ? $form::findOne($attributeId) : $form;
        
        if ( ! $form) {
            throw new Exception(sprintf(
                "Не найдена модель AttributeForm с ИД: %d",
                $attributeId
            ));
        }
        
        return $form;
    }
    
    /**
     * Форма для выбора существуещего
     *
     * @param AttributeSelectForm $form
     *
     * @return AttributeSelectForm
     */
    public static function getSelectForm(AttributeSelectForm $form): AttributeSelectForm
    {
        return $form;
    }
    
    /**
     * данные для select2
     *
     * @return array
     */
    public static function dataForSelect2(): array
    {
        $rows = AttributeTable::find()
            ->select('
                attribute.id, 
                attribute.name as a_name, 
                type_value.name as t_name, 
                dictionary.name as d_name, 
                unit.shortName as u_name
            ')
            ->joinWith('unit')
            ->joinWith('dictionary')
            ->joinWith('type')
            ->where(['attribute.isDelete' => 0])
            ->asArray()
            ->all();

        return ArrayHelper::map(
            $rows,
            'id',
            function ($row) {
                return sprintf('%s (ид: %d%s%s%s)',
                    $row['a_name'],
                    $row['id'],
                    $row['t_name'] ? ', тип: ' . $row['t_name'] : '',
                    $row['d_name'] ? ', спр-к: ' . $row['d_name'] : '',
                    $row['u_name'] ? ', ед/изм: ' . $row['u_name'] : '',
                );
            });
    }
    
    /**
     * Последний (максимальный) ИД
     *
     * @return int
     */
    public static function lastId(): int
    {
        return AttributeTable::lastId();
    }
    
}
