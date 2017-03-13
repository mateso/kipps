<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "expenditure_payments".
 *
 * @property integer $expenditure_payment_id
 * @property integer $expenditure_id
 * @property double $amount
 * @property string $date_paid
 * @property integer $who_created
 * @property string $date_created
 *
 * @property Expenditures $expenditure
 */
class ExpenditurePayments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'expenditure_payments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['expenditure_id', 'amount'], 'required'],
            [['expenditure_id', 'who_created'], 'integer'],
            [['amount'], 'number'],
            [['date_paid', 'date_created'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'expenditure_payment_id' => 'Expenditure Payment ID',
            'expenditure_id' => 'Expenditure ID',
            'amount' => 'Amount',
            'date_paid' => 'Date Paid',
            'who_created' => 'Who Created',
            'date_created' => 'Date Created',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExpenditure()
    {
        return $this->hasOne(Expenditures::className(), ['expenditure_id' => 'expenditure_id']);
    }
}
