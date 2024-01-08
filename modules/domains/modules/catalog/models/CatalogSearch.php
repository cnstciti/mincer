<?php declare(strict_types = 1);

namespace modules\domains\modules\catalog\models;

use yii\data\ActiveDataProvider;

class CatalogSearch extends CatalogTable
{
    
    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['id', 'parentId', 'isEndItem', 'isDelete'], 'integer'],
            [['name', 'prefixEntity', 'formatEntity'], 'string'],
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

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $this->load($params);
        
        if ( ! $this->validate()) {
            return $dataProvider;
        }
        
        $query
            ->andFilterWhere([
                'id'        => $this->id,
                'parentId'  => $this->parentId,
                'isEndItem' => $this->isEndItem,
                'isDelete'  => $this->isDelete,
            ])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'prefixEntity', $this->prefixEntity])
            ->andFilterWhere(['like', 'formatEntity', $this->formatEntity]);
        
        return $dataProvider;
    }
    
}
