<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\KipsUsers;

/**
 * KipsUsersSearch represents the model behind the search form about `app\models\KipsUsers`.
 */
class KipsUsersSearch extends KipsUsers {

    public function rules() {
        return [
            [['userid', 'class'], 'integer'],
            [['firstname', 'surname', 'middlename', 'gender', 'phone', 'email', 'username', 'password', 'active', 'date_of_birth', 'place_of_birth', 'religion', 'denomination', 'tribe', 'class','student_type','transport_route'], 'safe'],
        ];
    }

    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params,$condition) {
        $query = KipsUsers::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if ($condition != NULL) {
            $query->andWhere($condition);
        }
        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'userid' => $this->userid,
            'class' => $this->class,
             'student_type' => $this->student_type,
        ]);

        $query->andFilterWhere(['like', 'firstname', $this->firstname])
                ->andFilterWhere(['like', 'surname', $this->surname])
                ->andFilterWhere(['like', 'middlename', $this->middlename])
                ->andFilterWhere(['like', 'gender', $this->gender])
                ->andFilterWhere(['like', 'phone', $this->phone])
                ->andFilterWhere(['like', 'email', $this->email])
                ->andFilterWhere(['like', 'username', $this->username])
                ->andFilterWhere(['like', 'password', $this->password])
                ->andFilterWhere(['like', 'active', $this->active])
                ->andFilterWhere(['like', 'date_of_birth', $this->date_of_birth])
                ->andFilterWhere(['like', 'place_of_birth', $this->place_of_birth])
                ->andFilterWhere(['like', 'religion', $this->religion])
                ->andFilterWhere(['like', 'transport_route', $this->transport_route])
                ->andFilterWhere(['like', 'denomination', $this->denomination])
                ->andFilterWhere(['like', 'tribe', $this->tribe]);

        return $dataProvider;
    }

}
