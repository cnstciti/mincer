<?php declare(strict_types = 1);

namespace modules\domains\modules\entity\models;

use yii\data\ActiveDataProvider;

class EntitySearch extends EntityTable
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
        $query = self::find()
            ->leftJoin(['ce' => 'catalog_entity'], 'ce.entityId=entity.id');

        $dataProvider = new ActiveDataProvider(['query' => $query]);
        
        $this->load($params);
        
        if ( ! $this->validate()) {
            return $dataProvider;
        }
        
        $query
            ->andFilterWhere([
                'id'        => $this->id,
                //'isDelete'  => $this->isDelete,
                'ce.catalogId' => $params['catalogId'],
            ])
            ->andFilterWhere(['like', 'name', $this->name])
            ->orderBy('id desc')
        ;
        
        return $dataProvider;
    }
    
}
