<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Gender;

/**
 * GenderSearch represents the model behind the search form about `app\models\Gender`.
 */
class GenderSearch extends Gender
{
    public function rules()
    {
        return [
            [['gender_id'], 'integer'],
            [['desc_en'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Gender::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'gender_id' => $this->gender_id,
        ]);

        $query->andFilterWhere(['like', 'desc_en', $this->desc_en]);

        return $dataProvider;
    }
}
