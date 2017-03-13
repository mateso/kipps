<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\KipsPaymentSetup;

/**
 * KipsPaymentSetupSearch represents the model behind the search form about `app\models\KipsPaymentSetup`.
 */
class KipsPaymentSetupSearch extends KipsPaymentSetup {

    public function rules() {
        return [
            [['id', 'education_level', 'payment_type', 'status', 'fee_category', 'financial_year_id', 'installment', 'transport_routes','required'], 'integer'],
            [['amount'], 'number'],
            [['due_date','start_date'], 'safe'],
        ];
    }

    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params) {
        $query = KipsPaymentSetup::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'required' => $this->required,
            'education_level' => $this->education_level,
            'payment_type' => $this->payment_type,
            'transport_routes' => $this->transport_routes,
            'financial_year_id' => $this->financial_year_id,
            'amount' => $this->amount,
            'start_date' => $this->start_date,
            'due_date' => $this->due_date,
            'status' => $this->status,
            'fee_category' => $this->fee_category,
            'installment' => $this->installment,
        ]);

        return $dataProvider;
    }

}
