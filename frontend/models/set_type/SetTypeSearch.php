<?php declare(strict_types = 1);

namespace modules\domains\modules\set_type\models;

use yii\data\ActiveDataProvider;

class SetTypeSearch extends SetTypeDataView
{
    
    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['attributeName', 'typeName', 'unitName', 'dictionaryName', 'value'], 'string'],
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
        $query = self::find()
            ->where(['catalogId' => $params['catalogId'], 'entityId' => $params['entityId']]);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->pagination->pageSize = 50;

        $this->load($params);
        
        if ( ! $this->validate()) {
            return $dataProvider;
        }
        
        $query
            ->andFilterWhere(['like', 'attributeName', $this->attributeName])
            ->andFilterWhere(['like', 'typeName', $this->typeName])
            ->andFilterWhere(['like', 'unitName', $this->unitName])
            ->andFilterWhere(['like', 'dictionaryName', $this->dictionaryName])
            ->andFilterWhere(['like', 'value', $this->value])
        ;
        
        return $dataProvider;
    }
    
}
