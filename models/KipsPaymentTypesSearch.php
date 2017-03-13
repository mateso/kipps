<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\KipsPaymentTypes;

/**
 * KipsPaymentTypesSearch represents the model behind the search form about `app\models\KipsPaymentTypes`.
 */
class KipsPaymentTypesSearch extends KipsPaymentTypes
{
    public function rules()
    {
        return [
            [['id','status'], 'integer'],
            [['payment_type', 'description'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params, $condition = NULL)
    {
        $query = KipsPaymentTypes::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        
        $this->load($params);

        if($condition != NULL){
            $query->andWhere($condition);
        }
        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'payment_type', $this->payment_type])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}