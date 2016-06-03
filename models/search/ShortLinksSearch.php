<?php

namespace mitrm\links\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use mitrm\links\models\ShortLinks;

/**
 * ShortLinksSearch represents the model behind the search form about `mitrm\links\models\ShortLinks`.
 */
class ShortLinksSearch extends ShortLinks
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'count_click', 'field_id', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['link', 'short', 'table'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ShortLinks::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id'=> SORT_DESC,
                ]
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'count_click' => $this->count_click,
            'field_id' => $this->field_id,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'link', $this->link])
            ->andFilterWhere(['like', 'short', $this->short])
            ->andFilterWhere(['like', 'table', $this->table]);

        return $dataProvider;
    }
}
