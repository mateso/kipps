<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\KipsTransportRoutes;

/**
 * KipsTransportRoutesSearch represents the model behind the search form about `app\models\KipsTransportRoutes`.
 */
class KipsTransportRoutesSearch extends KipsTransportRoutes
{
    public function rules()
    {
        return [
            [['id', 'route_number'], 'integer'],
            [['area_covered'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = KipsTransportRoutes::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'route_number' => $this->route_number,
        ]);

        $query->andFilterWhere(['like', 'area_covered', $this->area_covered]);

        return $dataProvider;
    }
}
