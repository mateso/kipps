<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\KipsContacts;

/**
 * KipsContactsSearch represents the model behind the search form about `app\models\KipsContacts`.
 */
class KipsContactsSearch extends KipsContacts {

    public function rules() {
        return [
            [['id', 'student_id'], 'integer'],
            [['contact_first_name', 'contact_middle_name', 'contact_surname', 'contact_occupation', 'contact_religion', 'contact_postal_address', 'contact_residential', 'contact_telephone', 'contact_mobile_phone', 'contact_office_phone', 'contact_type'], 'safe'],
        ];
    }

    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params, $contactCondition = NULL) {
        $query = KipsContacts::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if ($contactCondition != NULL) {
            $query->andWhere($contactCondition);
        }
        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'student_id' => $this->student_id,
        ]);

        $query->andFilterWhere(['like', 'contact_first_name', $this->contact_first_name])
                ->andFilterWhere(['like', 'contact_middle_name', $this->contact_middle_name])
                ->andFilterWhere(['like', 'contact_type', $this->contact_type])
                ->andFilterWhere(['like', 'contact_surname', $this->contact_surname])
                ->andFilterWhere(['like', 'contact_occupation', $this->contact_occupation])
                ->andFilterWhere(['like', 'contact_religion', $this->contact_religion])
                ->andFilterWhere(['like', 'contact_postal_address', $this->contact_postal_address])
                ->andFilterWhere(['like', 'contact_residential', $this->contact_residential])
                ->andFilterWhere(['like', 'contact_telephone', $this->contact_telephone])
                ->andFilterWhere(['like', 'contact_mobile_phone', $this->contact_mobile_phone])
                ->andFilterWhere(['like', 'contact_office_phone', $this->contact_office_phone]);

        return $dataProvider;
    }

}