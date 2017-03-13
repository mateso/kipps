<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payments_amount".
 *
 * @property integer $id
 * @property integer $payments_id
 * @property integer $payment_setup_id
 * @property double $amount
 *
 * @property PaymentSetup $paymentSetup
 * @property Payments $payments
 */
class PaymentsAmount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payments_amount';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['payments_id', 'payment_setup_id', 'amount'], 'required'],
            [['payments_id', 'payment_setup_id','student_id','student_class'], 'integer'],
            [['amount'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'payments_id' => 'Payments ID',
            'payment_setup_id' => 'Payment Setup ID',
            'amount' => 'Amount',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentSetup()
    {
        return $this->hasOne(KipsPaymentSetup::className(), ['id' => 'payment_setup_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasOne(KipsPayments::className(), ['id' => 'payments_id']);
    }
}