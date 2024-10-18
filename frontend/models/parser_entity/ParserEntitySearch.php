<?php declare(strict_types = 1);

namespace frontend\models\parser_entity;

use frontend\models\tables\ParserEntityTable;
use yii\data\ActiveDataProvider;

class ParserEntitySearch extends ParserEntityTable
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
            ->leftJoin(['ps' => 'parser_site'], 'parser_entity.parserSiteId=ps.id');

        $dataProvider = new ActiveDataProvider(['query' => $query]);
        
        $this->load($params);
        
        if ( ! $this->validate()) {
            return $dataProvider;
        }
        
        $query
            ->andFilterWhere([
                'id'        => $this->id,
                //'isDelete'  => $this->isDelete,
                //'ce.catalogId' => $params['catalogId'],
            ])
            ->andFilterWhere(['like', 'name', $this->name])
            ->orderBy('id desc')
        ;
        
        return $dataProvider;
    }
    
}
