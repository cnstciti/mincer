<?php declare(strict_types = 1);

namespace modules\domains\modules\attribute\models;

use Exception;
use Throwable;
use yii\db\Query;
use yii\helpers\ArrayHelper;

class AttributeService
{
    private const TITLE = 'Атрибуты';
    
    
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
    ): string
    {
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
    public function getForm(AttributeForm $form, int $attributeId = 0): AttributeForm
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
     * данные для select2
     *
     * @param int $catalogId
     * @return array
     */
    public function dataForSelect2(int $catalogId): array
    {
        // не включаем в список уже привязанные к каталогу атрибуты
        $caIds = (new Query())
            ->select('attributeId')
            ->from('catalog_attribute')
            ->where(['catalogId' => $catalogId]);
        
        $rows = AttributeTable::find()
            ->select('a.id, a.name as a_name, t.name as t_name, d.name as d_name, u.name as u_name')
            ->from(['a' => 'attribute'])
            ->leftJoin(['u' => 'unit'], 'a.unitId=u.id')
            ->leftJoin(['d' => 'dictionary'], 'a.dictionaryId=d.id')
            ->leftJoin(['t' => 'type_value'], 'a.typeValueId=t.id')
            //->where(['a.isDelete' => 0])
            ->andWhere(['not in', 'a.id', $caIds])
            ->asArray()
            ->all();
        
        return ArrayHelper::map(
            $rows,
            'id',
            function ($row) {
                return sprintf('%s (ид: %d, тип: %s, спр-к: %s, ед/изм: %s)',
                    $row['a_name'],
                    $row['id'],
                    $row['t_name'],
                    $row['d_name'],
                    $row['u_name'],
                );
            });
    }
    
    /**
     * Последний (максимальный) ИД
     *
     * @return int
     */
    public function lastId(): int
    {
        return AttributeTable::lastId();
    }
    
}
