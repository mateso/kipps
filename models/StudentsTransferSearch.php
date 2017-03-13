<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\StudentsTransfer;

/**
 * StudentsTransferSearch represents the model behind the search form about `app\models\StudentsTransfer`.
 */
class StudentsTransferSearch extends StudentsTransfer
{
    public function rules()
    {
        return [
            [['semester', 'userid', 'YearID', 'transfer_type'], 'integer'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = StudentsTransfer::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'semester' => $this->semester,
            'userid' => $this->userid,
            'YearID' => $this->YearID,
            'transfer_type' => $this->transfer_type,
        ]);

        return $dataProvider;
    }
}
