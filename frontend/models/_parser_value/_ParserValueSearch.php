<?php declare(strict_types = 1);

namespace frontend\models\parser_value;

use frontend\models\tables\ParserValueTable;
use yii\data\ActiveDataProvider;

class ParserValueSearch extends ParserValueTable
{
    
    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['id'], 'integer'],
            //[['name', 'status'], 'string'],
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
            ->leftJoin(['pea' => 'parser_entity_attribute'], 'pea.parserAttributeId=parser_attribute.id')
            ->leftJoin(['pe' => 'parser_entity'], 'pea.parserEntityId=pe.id');

        $dataProvider = new ActiveDataProvider(['query' => $query]);
        
        $this->load($params);
        
        if ( ! $this->validate()) {
            return $dataProvider;
        }
        
        $query
            ->andFilterWhere([
                'id'        => $this->id,
                //'isBaseEntity'  => $this->isBaseEntity,
                'pe.catalogId' => $params['catalogId'],
            ])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'status', $this->status])
            //->orderBy('id desc')
        ;
        
        return $dataProvider;
    }
    
}
