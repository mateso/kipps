<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "expenditures".
 *
 * @property integer $expenditure_id
 * @property integer $financial_year
 * @property integer $expenditure_type
 * @property string $expenditure_description
 * @property double $amount
 * @property string $expenditure_date
 * @property string $status
 * @property string $date_created
 * @property integer $who_created
 *
 * @property ExpenditureTypes $expenditureType
 * @property FinancialYears $financialYear
 */
class Expenditures extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'expenditures';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['financial_year', 'expenditure_type', 'amount', 'expenditure_date'], 'required'],
            [['financial_year', 'expenditure_type', 'who_created','status'], 'integer'],
            [['amount'], 'number'],
            [['expenditure_date', 'date_created'], 'safe'],
            [['expenditure_description'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'expenditure_id' => 'Expenditure ID',
            'financial_year' => 'Financial Year',
            'expenditure_type' => 'Expenditure Type',
            'expenditure_description' => 'Expenditure Description',
            'amount' => 'Amount',
            'expenditure_date' => 'Expenditure Date',
            'status' => 'Status',
            'date_created' => 'Date Created',
            'who_created' => 'Who Created',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExpenditureType()
    {
        return $this->hasOne(ExpenditureTypes::className(), ['expenditure_type_id' => 'expenditure_type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFinancialYear()
    {
        return $this->hasOne(FinancialYears::className(), ['YearID' => 'financial_year']);
    }
}
