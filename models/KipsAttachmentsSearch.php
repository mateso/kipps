<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\KipsAttachments;

/**
 * KipsAttachmentsSearch represents the model behind the search form about `app\models\KipsAttachments`.
 */
class KipsAttachmentsSearch extends KipsAttachments
{
    public function rules()
    {
        return [
            [['id', 'student_id'], 'integer'],
            [['attchment_type', 'attchment'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = KipsAttachments::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'student_id' => $this->student_id,
        ]);

        $query->andFilterWhere(['like', 'attchment_type', $this->attchment_type])
            ->andFilterWhere(['like', 'attchment', $this->attchment]);

        return $dataProvider;
    }
}
