<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kips_payments".
 *
 * @property integer $id
 * @property integer $student_id
 * @property integer $status
 * @property integer $financial_year_id
 * @property integer $payment_setup_id	
 * @property double $amount_paid
 * @property string $description
 * @property string $receipt_date
 * @property string $date_paid
 * @property string $student_type
 * @property integer $transport_route
 * @property string $receipt_number
 * @property string $transaction_date
 *
 * @property KipsUsers $student
 * @property KipsPaymentSetup $paymentSetUp
 */
class KipsPayments extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'payments';
    }

    public $tution_fee;
    public $transport_fee;
    public $uniform_fee;
    public $examination_fee;
    public $remedial_class_fee;
    public $admission_fee;
    public $graduation_contribution_fee;
    public $tour_fee;
    public $application_fee;
    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['student_id','student_type','amount_paid'], 'required'],
            [['id', 'student_id','status', 'financial_year_id','transport_route', 'receipt_number','student_class','payment_setup_id'], 'integer'],
            [['amount_paid','tution_fee', 'transport_fee', 'uniform_fee', 'examination_fee', 'remedial_class_fee', 'admission_fee', 'graduation_contribution_fee', 'tour_fee', 'application_fee'], 'number'],
            [['description', 'receipt_date', 'date_paid', 'payment_method','student_type'], 'string'],
            [['tution_fee', 'transport_fee', 'uniform_fee', 'examination_fee', 'remedial_class_fee', 'admission_fee', 'graduation_contribution_fee', 'tour_fee', 'application_fee','transaction_date','financial_year_id'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'student_id' => 'Student',
            'status' => 'Status',
            'financial_year_id' => 'Financial Year',
            'payment_setup_id' => 'Payment setup',
            'amount_paid' => 'Pay-in slip Amount',
            'receipt_number' => 'Pay-in slip Number (Optional)',
            'receipt_date' => 'Date Submitted at School',
            'date_paid' => 'Pay-in Slip Date',
            'payment_method' => 'Payment Method',
            'student_type' => 'Student Type',
            'transport_route' => 'Transport Route',
            'tution_fee' => 'Tuition Fee Amount',
            'transport_fee' => 'Transport Fee Amount',
            'uniform_fee' => 'Uniform Fee Amount',
            'examination_fee' => 'Examination Fee Amount',
            'remedial_class_fee' => 'Remedial Class Fee Amount',
            'admission_fee' => 'Admission Fee Amount',
            'graduation_contribution_fee' => 'Graduation Fee Amount',
            'tour_fee' => 'Tour Fee Amount',
            'application_fee' => 'Application Fee Amount',
            'transaction_date' => 'Transaction Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent() {
        return $this->hasOne(KipsUsers::className(), ['userid' => 'student_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentSetUp() {
        return $this->hasOne(KipsPaymentSetup::className(), ['id' => 'payment_setup_id']);
    }
    
     public function getStudentClass()
    {
        return $this->hasOne(KipsEducationLevel::className(), ['id' => 'student_class']);
    }

}