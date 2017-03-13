<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;

/**
 * UserSearch represents the model behind the search form about `app\models\User`.
 */
class UserSearch extends User {

    public function rules() {
        return [
            [['userid', 'status', 'login_counts', 'failed_login_attempts'], 'integer'],
            [['username', 'password', 'firstname', 'middlename', 'surname', 'email', 'phone', 'last_login_date', 'last_password_update_date', 'auth_key', 'password_reset_token','tittle'], 'safe'],
        ];
    }

    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params, $condition = NULL) {
        $query = User::find();

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
            'userid' => $this->userid,
            'status' => $this->status,
            'login_counts' => $this->login_counts,
            'last_login_date' => $this->last_login_date,
            'failed_login_attempts' => $this->failed_login_attempts,
            'last_password_update_date' => $this->last_password_update_date,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])                
                ->andFilterWhere(['like', 'password', $this->password])
                ->andFilterWhere(['like', 'tittle', $this->tittle])
                ->andFilterWhere(['like', 'firstname', $this->firstname])
                ->andFilterWhere(['like', 'middlename', $this->middlename])
                ->andFilterWhere(['like', 'surname', $this->surname])
                ->andFilterWhere(['like', 'email', $this->email])
                ->andFilterWhere(['like', 'phone', $this->phone])
                ->andFilterWhere(['like', 'auth_key', $this->auth_key])
                ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token]);

        return $dataProvider;
    }

}
