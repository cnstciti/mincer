<?php declare(strict_types = 1);

namespace modules\domains\modules\dictionary_content\models;

use yii\data\ActiveDataProvider;

class DictionaryContentSearch extends DictionaryContentTable
{
    
    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['id'/*, 'isDelete'*/], 'integer'],
            [['value'], 'string'],
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
        $query = self::find();
        
        $dataProvider = new ActiveDataProvider(['query' => $query]);
        
        $this->load($params);
        
        if ( ! $this->validate()) {
            return $dataProvider;
        }
        
        $query
            ->andFilterWhere([
                'id'           => $this->id,
                //'isDelete'     => $this->isDelete,
                'dictionaryId' => $params['dictionaryId'],
            ])
            ->andFilterWhere(['like', 'value', $this->value]);
        
        return $dataProvider;
    }
    
}
