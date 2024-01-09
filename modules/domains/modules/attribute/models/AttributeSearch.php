<?php declare(strict_types = 1);

namespace modules\domains\modules\attribute\models;

use yii\data\ActiveDataProvider;

class AttributeSearch extends AttributeTable
{
    
    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['id', 'isDelete'], 'integer'],
            [['name'], 'string'],
        ];
    }
    
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search(array $params): ActiveDataProvider
    {
        // TODO Посмотреть ->joinWith
        $query = self::find()
                     //->from(['a' => 'attribute'])
                     ->leftJoin(['ca' => 'catalog_attribute'], 'ca.attributeId=attribute.id');
        //->leftJoin(['c' => 'catalog'], 'ca.catalogId=c.id');
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $this->load($params);
        
        if ( ! $this->validate()) {
            return $dataProvider;
        }
        
        $query
            ->andFilterWhere([
                'id'           => $this->id,
                'isDelete'     => $this->isDelete,
                'ca.catalogId' => $params['catalogId'],
                //'c.id'     => $params['catalogId'],
            ])
            ->andFilterWhere(['like', 'name', $this->name]);
        
        return $dataProvider;
    }
    
}
