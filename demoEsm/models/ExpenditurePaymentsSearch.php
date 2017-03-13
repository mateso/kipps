<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ExpenditurePayments;

/**
 * ExpenditurePaymentsSearch represents the model behind the search form about `app\models\ExpenditurePayments`.
 */
class ExpenditurePaymentsSearch extends ExpenditurePayments
{
    public function rules()
    {
        return [
            [['expenditure_payment_id', 'expenditure_id', 'who_created'], 'integer'],
            [['amount', 'date_paid', 'date_created'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = ExpenditurePayments::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'expenditure_payment_id' => $this->expenditure_payment_id,
            'expenditure_id' => $this->expenditure_id,
            'date_paid' => $this->date_paid,
            'who_created' => $this->who_created,
            'date_created' => $this->date_created,
        ]);

        $query->andFilterWhere(['like', 'amount', $this->amount]);

        return $dataProvider;
    }
}
