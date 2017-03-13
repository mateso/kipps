<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\KipsMedics;

/**
 * KipsMedicsSearch represents the model behind the search form about `app\models\KipsMedics`.
 */
class KipsMedicsSearch extends KipsMedics
{
    public function rules()
    {
        return [
            [['id', 'student_id'], 'integer'],
            [['medics'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = KipsMedics::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'student_id' => $this->student_id,
        ]);

        $query->andFilterWhere(['like', 'medics', $this->medics]);

        return $dataProvider;
    }
}
