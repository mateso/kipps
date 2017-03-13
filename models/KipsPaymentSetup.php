<?php

namespace app\models;

use Yii;
use app\models\FinancialYears;
use app\models\StudentFinancialYear;

/**
 * This is the model class for table "kips_payment_setup".
 *
 * @property integer $id
 * @property integer $financial_year_id
 * @property integer $education_level_id
 * @property integer $payment_type
 * @property double $amount
 * @property string $due_date
 * @property integer $status
 *
 * @property KipsPaymentTypes $paymentType
 * @property KipsEducationLevel $educationLevel
 * @property KipsPayments[] $kipsPayments
 */
class KipsPaymentSetup extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'payment_setup';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['payment_type', 'installment'], 'required'],
            [['id', 'education_level', 'payment_type', 'status', 'financial_year_id', 'installment', 'transport_routes', 'required'], 'integer'],
            [['amount'], 'number'],
            [['due_date', 'fee_category', 'start_date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'education_level' => 'Education Level',
            'payment_type' => 'Payment Type',
            'transport_routes' => 'Route',
            'financial_year_id' => 'Financial Year',
            'fee_category' => 'Fee Category',
            'amount' => 'Amount',
            'start_date' => 'Start Date',
            'due_date' => 'Due Date',
            'status' => 'Active?',
            'installment' => 'Installment',
            'required' => 'Required?',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentType() {
        return $this->hasOne(KipsPaymentTypes::className(), ['id' => 'payment_type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEducationLevel() {
        return $this->hasOne(KipsEducationLevel::className(), ['id' => 'education_level']);
    }

    public function getTransportRoute() {
        return $this->hasOne(KipsEducationLevel::className(), ['id' => 'transport_routes']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKipsPayments() {
        return $this->hasMany(KipsPayments::className(), ['payment_setup_id' => 'id']);
    }

    public static function getArrayStatus() {
        return [
            '' => 'Select Status',
            1 => Yii::t('app', 'STATUS_ACTIVE'),
            2 => Yii::t('app', 'STATUS_INACTIVE'),
            3 => Yii::t('app', 'STATUS_DELETED'),
        ];
    }

    public static function getFeeCategory() {
        return [
            '' => 'Select Status',
            '1' => Yii::t('app', 'Boarding'),
            '2' => Yii::t('app', 'Day'),
            '3' => Yii::t('app', 'All'),
        ];
    }

    public static function getInstallments() {
        return [
            '' => 'Select Installment',
            '1' => Yii::t('app', 'First Installment'),
            '2' => Yii::t('app', 'Second Installment'),
            '3' => Yii::t('app', 'Third Installment'),
        ];
    }

    public static function getPaymentsFor($payment_setup_id) {
        $model = self::findOne(['id' => $payment_setup_id]);
        $payment_for = $model->educationLevel->education_level . ' ' . $model->paymentType->payment_type . '  (' . number_format($model->amount, 0) . ')';
        return $payment_for;
    }

    public static function getPaymentsFor2($payment_setup_id) {
        $model = self::findOne(['id' => $payment_setup_id]);
        $payment_for = $model->paymentType->payment_type . ' (' . number_format($model->amount, 0) . ')';
        return $payment_for;
    }

    public static function getPaymentSetupID($student_id, $financial_year, $payment_type) {
        $studentDetails = KipsPaymentSetup::getStudentDetails($student_id, $financial_year);
        $class = $studentDetails[0]['class'];
        $student_type = $studentDetails[0]['student_type'];
        if ($payment_type == 1) {
            $model = self::findOne(['financial_year_id' => $financial_year, 'education_level' => $class, 'payment_type' => $payment_type, 'fee_category' => $student_type]);
            if($model == null)
            	return null;
            return $model->id;
        } elseif ($payment_type == 2) {
            $model = self::findOne(['financial_year_id' => $financial_year, 'payment_type' => $payment_type, 'fee_category' => $student_type]);
            return $model->id;
        }
    }

    public static function getStudentDetails($student_id, $financial_year) {
            if ($financial_year == FinancialYears::getOperationalYear()) {
            $studentDetails = User::find()->Where(['userid' => $student_id])->all();
            return $studentDetails;
        } else {               
            $studentDetails = StudentFinancialYear::findBySql("SELECT student_type_id as student_type, class_id as class FROM `student_financial_year` WHERE `student_id` = " . $student_id . " AND `financial_year_id` = " . $financial_year . "")->all();
             //echo 'hapaet'; die();

                        return $studentDetails;        }
    }

    public static function getPaymentsFor3($payment_setup_id) {
        $model = self::findOne(['id' => $payment_setup_id]);
        $payment_for = $model->paymentType->payment_type;
        return $payment_for;
    }

    public static function getStudentAmountToBePaid($student_id, $financial_year, $payment_type) {
        $studentDetails = KipsPaymentSetup::getStudentDetails($student_id, $financial_year);
        $class = $studentDetails[0]['class'];
        $student_type = $studentDetails[0]['student_type'];
//        echo $class;
//        echo $student_type;
//        echo $payment_type;
//        die();
        if ($payment_type == 1 || $payment_type == 3) {
            $q = KipsPaymentSetup::findBySql("SELECT amount FROM `payment_setup` WHERE `education_level` = " . $class . " AND `fee_category` = '" . $student_type . "' AND `payment_type` = " . $payment_type);
            if($q == null)
            {
            	return null;
            }
            $amount_to_be_paid = $q->asArray()->one();
            return $amount_to_be_paid['amount'];
        } elseif ($payment_type == 2) {
            $amount_to_be_paid = KipsPaymentSetup::findBySql("SELECT amount FROM `payment_setup` WHERE `fee_category` = " . $student_type . " AND `payment_type` = " . $payment_type)->asArray()->one();
            return $amount_to_be_paid['amount'];
        } else {
            $amount_to_be_paid = KipsPaymentSetup::findBySql("SELECT amount FROM `payment_setup` WHERE `fee_category` = " . $student_type . " AND `payment_type` = " . $payment_type)->asArray()->one();
            return $amount_to_be_paid['amount'];
        }
    }

    public static function getStudentDeptAmountPaid($student_id, $payment_setup_id) {
//        echo $student_id;
//        echo '<br />';
//        echo $payment_setup_id;
//        die();
    	if($payment_setup_id == null){
    	return null;
        }
        $amount_paid = PaymentsAmount::findBySql("SELECT SUM(`payments_amount`.`amount`) AS `total_amount_paid`  FROM `payments_amount` INNER JOIN `payments` ON `payments_amount`.`payments_id` = `payments`.`id` WHERE `payments_amount`.`payment_setup_id` = " . $payment_setup_id . " AND `payments_amount`.`student_id` = " . $student_id . " AND `payments`.`status` = 1")->asArray()->one();
        return $amount_paid['total_amount_paid'];
    }

    public static function getDebtBalance($student_id, $financial_year, $payment_type, $payment_setup_id) {
        $amount_to_be_paid = self::getStudentAmountToBePaid($student_id, $financial_year, $payment_type);
        $amount_paid = self::getStudentDeptAmountPaid($student_id, $payment_setup_id);
        $balance = $amount_to_be_paid - $amount_paid;
        return $balance;
    }

    public static function getStudentAmountPaid($payment_setup_id, $student_id) {
        $amount_paid = PaymentsAmount::findBySql("SELECT SUM(`payments_amount`.`amount`) AS `total_amount_paid`  FROM `payments_amount` INNER JOIN `payments` ON `payments_amount`.`payments_id` = `payments`.`id` WHERE `payments_amount`.`payment_setup_id` = " . $payment_setup_id . " AND `payments_amount`.`student_id` = " . $student_id . " AND `payments`.`status` = 1")->asArray()->one();
        return $amount_paid['total_amount_paid'];
    }

    public static function getStudentPaymentSetUpBalance($payment_setup_id, $student_id, $payments_id) {
        $model = self::findOne(['id' => $payment_setup_id]);
        $amount_paid = PaymentsAmount::findBySql("SELECT SUM(`payments_amount`.`amount`) AS `total_amount_paid`  FROM `payments_amount` INNER JOIN `payments` ON `payments_amount`.`payments_id` = `payments`.`id` WHERE `payments_amount`.`payment_setup_id` = " . $payment_setup_id . " AND `payments_amount`.`student_id` = " . $student_id . " AND `payments`.`status` = 1 AND `payments_amount`.`payments_id`<=" . $payments_id)->asArray()->one();
        $balance = $model->amount - $amount_paid['total_amount_paid'];
        return $balance;
    }

}
