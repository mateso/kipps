<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Expenditures;

/**
 * ExpendituresSearch represents the model behind the search form about `app\models\Expenditures`.
 */
class ExpendituresSearch extends Expenditures {

    public function rules() {
        return [
            [['expenditure_id', 'financial_year', 'expenditure_type', 'who_created'], 'integer'],
            [['expenditure_description', 'amount', 'expenditure_date', 'status', 'date_created','invoice_number'], 'safe'],
        ];
    }

    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params, $condition = NULL) {
        $query = Expenditures::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if ($condition != NULL) {
            $query->andWhere($condition)
                    ->orderBy("expenditure_date DESC");
        }
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'expenditure_id' => $this->expenditure_id,
            'financial_year' => $this->financial_year,
            'expenditure_type' => $this->expenditure_type,
            'expenditure_date' => $this->expenditure_date,
            'date_created' => $this->date_created,
            'who_created' => $this->who_created,
            'invoice_number' => $this->invoice_number,
        ]);

        $query->andFilterWhere(['like', 'expenditure_description', $this->expenditure_description])
                ->andFilterWhere(['like', 'amount', $this->amount])
                ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }

}
