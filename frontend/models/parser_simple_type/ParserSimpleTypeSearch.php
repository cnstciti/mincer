<?php declare(strict_types = 1);

namespace frontend\models\parser_simple_type;

use yii\data\ActiveDataProvider;

class ParserSimpleTypeSearch extends ParserSimpleTypeDataView
{
    
    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['attributeName', 'typeName', 'unitName', 'dictionaryName', 'meaning'], 'string'],
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
            ->where([/*'catalogId' => $params['catalogId'], */'parserEntityId' => $params['parserEntityId']]);
        
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
            ->andFilterWhere(['like', 'meaning', $this->meaning])
        ;
    
        $query->orderBy('attributeName');
        
        return $dataProvider;
    }
    
}
