<?php
namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Vwstudentpayments;


/**
 * VwstudentpaymentsSearch represents the model behind the search form about `app\models\Vwstudentpayments`.
 */
class VwstudentpaymentsSearch extends Vwstudentpayments
{
    public function rules()
    {
        return [
            [['id', 'student_id', 'transport_route', 'payments_id', 'payment_setup_id'], 'integer'],
            [['amount_paid', 'description', 'date_paid', 'receipt_date', 'receipt_number', 'payment_method', 'student_type', 'amount'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params,$studentPaymentsCondition = NULL)
    {
        $query = Vwstudentpayments::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

         $this->load($params);
        if ($studentPaymentsCondition != NULL) {
            $query->andWhere($studentPaymentsCondition)
                  ->groupBy(['payment_setup_id']);
        }
        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'date_paid' => $this->date_paid,
            'receipt_date' => $this->receipt_date,
            'student_id' => $this->student_id,
            'transport_route' => $this->transport_route,
            'payments_id' => $this->payments_id,
            'payment_setup_id' => $this->payment_setup_id,
        ]);

        $query->andFilterWhere(['like', 'amount_paid', $this->amount_paid])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'receipt_number', $this->receipt_number])
            ->andFilterWhere(['like', 'payment_method', $this->payment_method])
            ->andFilterWhere(['like', 'student_type', $this->student_type])
            ->andFilterWhere(['like', 'amount', $this->amount]);

        return $dataProvider;
    }
}