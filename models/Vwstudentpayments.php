<?php

namespace app\models;


use Yii;

/**
 * This is the model class for table "vwstudentpayments".
 *
 * @property integer $id
 * @property double $amount_paid
 * @property string $description
 * @property string $date_paid
 * @property string $receipt_date
 * @property integer $student_id
 * @property string $receipt_number
 * @property string $payment_method
 * @property string $student_type
 * @property integer $transport_route
 * @property integer $payments_id
 * @property integer $payment_setup_id
 * @property double $amount
 */
class Vwstudentpayments extends \yii\db\ActiveRecord
{
     static public function primaryKey() {
       return ['id']; 
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vwstudentpayments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'student_id', 'transport_route', 'payments_id', 'payment_setup_id'], 'integer'],
            [['amount_paid', 'date_paid', 'student_id', 'payments_id', 'payment_setup_id', 'amount'], 'required'],
            [['amount_paid', 'amount'], 'number'],
            [['date_paid', 'receipt_date'], 'safe'],
            [['description', 'payment_method'], 'string', 'max' => 255],
            [['receipt_number', 'student_type'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'amount_paid' => 'Amount Paid',
            'description' => 'Description',
            'date_paid' => 'Date Paid',
            'receipt_date' => 'Receipt Date',
            'student_id' => 'Student ID',
            'receipt_number' => 'Receipt Number',
            'payment_method' => 'Payment Method',
            'student_type' => 'Student Type',
            'transport_route' => 'Transport Route',
            'payments_id' => 'Payments ID',
            'payment_setup_id' => 'Payment Setup ID',
            'amount' => 'Amount',
        ];
    }
}
