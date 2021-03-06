<?php

namespace mitrm\links\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use mitrm\links\models\ShortLinksClick;

/**
 * ShortLinksClickSearch represents the model behind the search form about `mitrm\links\models\ShortLinksClick`.
 */
class ShortLinksClickSearch extends ShortLinksClick
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'short_links_id'], 'integer'],
            [['created_at'], 'safe'],
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
        $query = ShortLinksClick::find();

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
            'short_links_id' => $this->short_links_id,
        ]);

        if (!empty($this->created_at)) {
            $date = strtotime($this->created_at);
            $query->andFilterWhere(['between', 'created_at', $date, $date + 3600 * 24]);
        }

        return $dataProvider;
    }
}
