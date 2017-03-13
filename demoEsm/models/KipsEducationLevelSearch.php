<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\KipsEducationLevel;

/**
 * KipsEducationLevelSearch represents the model behind the search form about `app\models\KipsEducationLevel`.
 */
class KipsEducationLevelSearch extends KipsEducationLevel
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['education_level', 'description'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = KipsEducationLevel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'education_level', $this->education_level])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
