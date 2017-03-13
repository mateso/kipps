<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "expenditure_types".
 *
 * @property integer $expenditure_type_id
 * @property string $expenditure_type_name
 * @property string $expenditure_type_description
 * @property string $date_created
 * @property integer $who_created
 * @property integer $status
 *
 * @property Expenditures[] $expenditures
 */
class ExpenditureTypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'expenditure_types';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['expenditure_type_name'], 'required'],
            [['date_created'], 'safe'],
            [['who_created', 'status'], 'integer'],
            [['expenditure_type_name', 'expenditure_type_description'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'expenditure_type_id' => 'Expenditure Type ID',
            'expenditure_type_name' => 'Expenditure Type Name',
            'expenditure_type_description' => 'Expenditure Type Description',
            'date_created' => 'Date Created',
            'who_created' => 'Who Created',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExpenditures()
    {
        return $this->hasMany(Expenditures::className(), ['expenditure_type' => 'expenditure_type_id']);
    }
}
