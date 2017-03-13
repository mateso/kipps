<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "students_transfer".
 *
 * @property integer $id
 * @property integer $semester
 * @property integer $userid
 * @property integer $YearID
 * @property integer $transfer_type
 *
 * @property FinancialYears $year
 * @property User $user
 */
class StudentsTransfer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'students_transfer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'YearID', 'transfer_type'], 'required'],
            [['id', 'semester', 'userid', 'YearID', 'transfer_type'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'semester' => 'Semester',
            'userid' => 'Userid',
            'YearID' => 'Year ID',
            'transfer_type' => 'Transfer Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYear()
    {
        return $this->hasOne(FinancialYears::className(), ['YearID' => 'YearID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['userid' => 'userid']);
    }
}
