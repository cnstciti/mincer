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
            [['id', 'parentId', 'containsProducts'/*, 'isDelete'*/], 'integer'],
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
                'id'        => $this->id,
                'parentId'  => $this->parentId,
                'containsProducts' => $this->containsProducts,
                //'isDelete'  => $this->isDelete,
            ])
            ->andFilterWhere(['like', 'name', $this->name])
        ;
        
        return $dataProvider;
    }
    
}
