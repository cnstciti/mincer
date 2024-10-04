<?php declare(strict_types = 1);

namespace modules\domains\modules\dictionary\models;

use yii\data\ActiveDataProvider;

class DictionarySearch extends DictionaryTable
{
    
    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['id'/*, 'isDelete'*/], 'integer'],
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
        $query = self::find();
        
        $dataProvider = new ActiveDataProvider(['query' => $query]);
        
        $this->load($params);
        
        if ( ! $this->validate()) {
            return $dataProvider;
        }
        
        $query
            ->andFilterWhere([
                'id'       => $this->id,
                //'isDelete' => $this->isDelete,
            ])
            ->andFilterWhere(['like', 'name', $this->name]);
        
        return $dataProvider;
    }
    
}
