<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PaymentsAmount;

/**
 * PaymentsAmountSearch represents the model behind the search form about `app\models\PaymentsAmount`.
 */
class PaymentsAmountSearch extends PaymentsAmount
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'payments_id', 'payment_setup_id','student_id','student_class'], 'integer'],
            [['amount'], 'number'],
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
    public function search($params, $condition = NULL)
    {
        $query = PaymentsAmount::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
           // 'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]]
        ]);

        $this->load($params);

        if($condition != NULL){
            $query->andWhere($condition)
                  ->orderBy("id ASC");
        }
        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'payments_id' => $this->payments_id,
            'payment_setup_id' => $this->payment_setup_id,
            'student_id' => $this->student_id,
            'student_class' => $this->student_class,
            'amount' => $this->amount,
        ]);

        return $dataProvider;
    }
}