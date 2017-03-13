<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ExpenditureTypes;

/**
 * ExpenditureTypesSearch represents the model behind the search form about `app\models\ExpenditureTypes`.
 */
class ExpenditureTypesSearch extends ExpenditureTypes
{
    public function rules()
    {
        return [
            [['expenditure_type_id', 'who_created', 'status'], 'integer'],
            [['expenditure_type_name', 'expenditure_type_description', 'date_created'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = ExpenditureTypes::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'expenditure_type_id' => $this->expenditure_type_id,
            'date_created' => $this->date_created,
            'who_created' => $this->who_created,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'expenditure_type_name', $this->expenditure_type_name])
            ->andFilterWhere(['like', 'expenditure_type_description', $this->expenditure_type_description]);

        return $dataProvider;
    }
}
