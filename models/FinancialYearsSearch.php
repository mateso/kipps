<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FinancialYears;

/**
 * FinancialYearsSearch represents the model behind the search form about `app\models\FinancialYears`.
 */
class FinancialYearsSearch extends FinancialYears
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['YearID', 'IsCurrent', 'CoAVersionID', 'AdminAreaVersionID', 'PriorityAreaVersionID', 'NationalTargetVersionID'], 'integer'],
            [['FinancialYear', 'FYStart', 'FYEnd'], 'safe'],
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
    public function search($params)
    {
        $query = FinancialYears::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'YearID' => $this->YearID,
            'FYStart' => $this->FYStart,
            'FYEnd' => $this->FYEnd,
            'IsCurrent' => $this->IsCurrent,
            'CoAVersionID' => $this->CoAVersionID,
            'AdminAreaVersionID' => $this->AdminAreaVersionID,
            'PriorityAreaVersionID' => $this->PriorityAreaVersionID,
            'NationalTargetVersionID' => $this->NationalTargetVersionID,
        ]);

        $query->andFilterWhere(['like', 'FinancialYear', $this->FinancialYear]);

        return $dataProvider;
    }
}
