<?php declare(strict_types = 1);

namespace modules\domains\modules\value\models;

use yii\data\ActiveDataProvider;

class ImgTypeSearch extends ImgTypeDataView
{
    
    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['height', 'width', 'size'], 'integer'],
            [['attributeName', 'typeName', 'file', 'type', 'ext'], 'string'],
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
            ->andFilterWhere([
                'height' => $this->height,
                'width'  => $this->width,
                'size'   => $this->size,
            ])
            ->andFilterWhere(['like', 'attributeName', $this->attributeName])
            ->andFilterWhere(['like', 'typeName', $this->typeName])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'ext', $this->ext]);
        
        $query->orderBy('numGroup');
        
        return $dataProvider;
    }
    
}
