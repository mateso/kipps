<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\StatusList;

/**
 * StatusListSearch represents the model behind the search form about `app\models\StatusList`.
 */
class StatusListSearch extends StatusList
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status_list_id'], 'integer'],
            [['desc_en'], 'safe'],
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
        $query = StatusList::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'status_list_id' => $this->status_list_id,
        ]);

        $query->andFilterWhere(['like', 'desc_en', $this->desc_en]);

        return $dataProvider;
    }
}
