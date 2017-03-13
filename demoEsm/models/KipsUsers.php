<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kips_users".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $other_names
 * @property string $user_id
 * @property string $gender
 * @property resource $phone_number
 * @property string $email
 * @property string $user_name
 * @property resource $password
 * @property string $active
 * @property integer $num_login_fail
 * @property string $date_of_birth
 * @property string $place_of_birth
 * @property string $religion
 * @property string $denomination
 * @property string $tribe
 * @property integer $class
 *
 * @property KipsContacts[] $kipsContacts
 * @property KipsAttachments[] $kipsAttachments
 * @property KipsMedics[] $kipsMedics
 * @property KipsPayments[] $kipsPayments
 */
class KipsUsers extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['firstname', 'surname', 'username', 'class', 'student_type'], 'required'],
            [['firstname', 'surname', 'middlename', 'gender', 'phone', 'email', 'username', 'password', 'date_of_birth', 'place_of_birth', 'religion', 'denomination', 'tribe'], 'string'],
            [['userid', 'class', 'student_type', 'transport_route', 'active'], 'integer'],
//            [['username'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'userid' => 'User',
            'firstname' => 'First Name',
            'surname' => 'Surname',
            'middlename' => 'Middle Name',
            'gender' => 'Gender',
            'phone' => 'Phone Number',
            'email' => 'Email',
            'username' => 'Registration Number',
            'password' => 'Password',
            'active' => 'Active',
            'date_of_birth' => 'Date Of Birth',
            'place_of_birth' => 'Place Of Birth',
            'religion' => 'Religion',
            'denomination' => 'Denomination',
            'tribe' => 'Tribe',
            'class' => 'Class',
            'student_type' => 'Student Type',
            'transport_route' => 'Transport Route',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKipsContacts() {
        return $this->hasMany(KipsContacts::className(), ['student_id' => 'userid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKipsAttachments() {
        return $this->hasMany(KipsAttachments::className(), ['student_id' => 'userid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKipsMedics() {
        return $this->hasMany(KipsMedics::className(), ['student_id' => 'userid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKipsPayments() {
        return $this->hasMany(KipsPayments::className(), ['student_id' => 'userid']);
    }

    public static function getStudentName($student_id) {
        $model = self::findOne(['userid' => $student_id]);
        $student_name = $model->firstname . ' ' . $model->middlename . ' ' . $model->surname;
        return $student_name;
    }

    public static function getStudents() {
        $model = self::findOne(['userid' => $student_id]);
        $student_name = $model->firstname . ' ' . $model->middlename . ' ' . $model->surname;
        return $student_name;
    }

    public function getStudentClass() {
        return $this->hasOne(KipsEducationLevel::className(), ['id' => 'class']);
    }

    public function getTransportRoute() {
        return $this->hasOne(KipsTransportRoutes::className(), ['id' => 'transport_route']);
    }

}
