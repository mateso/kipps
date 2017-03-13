<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\KipsPayments;

/**
 * KipsPaymentsSearch represents the model behind the search form about `app\models\KipsPayments`.
 */
class KipsPaymentsSearch extends KipsPayments
{
    public function rules()
    {
        return [
            [['id', 'payment_setup_id', 'student_id', 'transport_route','student_class','status'], 'integer'],
            [['amount_paid', 'description', 'date_paid', 'receipt_date', 'receipt_number', 'payment_method', 'student_type','transaction_date'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params, $condition = NULL)
    {
        $query = KipsPayments::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            
        ]);

        $this->load($params);

        if($condition != NULL){
            $query->andWhere($condition)
            ->orderBy("receipt_date DESC");
        }
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'payment_setup_id' => $this->payment_setup_id,
            'student_id' => $this->student_id,
            'transport_route' => $this->transport_route,
            'student_class' => $this->student_class,
        ]);

        $query->andFilterWhere(['like', 'amount_paid', $this->amount_paid])
            ->andFilterWhere(['like', 'receipt_date', $this->receipt_date])
            ->andFilterWhere(['like', 'date_paid', $this->date_paid])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'receipt_number', $this->receipt_number])
            ->andFilterWhere(['like', 'payment_method', $this->payment_method])
            ->andFilterWhere(['like', 'transaction_date', $this->transaction_date])
            ->andFilterWhere(['like', 'student_type', $this->student_type]);
            
        return $dataProvider;
    }
}