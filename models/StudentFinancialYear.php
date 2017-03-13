<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "student_financial_year".
 *
 * @property integer $student_financial_year_id
 * @property integer $student_id
 * @property integer $student_type_id
 * @property integer $financial_year_id
 * @property integer $class_id
 */
class StudentFinancialYear extends \yii\db\ActiveRecord
{
    public $student_type;
    public $class;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student_financial_year';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_id', 'student_type_id', 'financial_year_id', 'class_id'], 'required'],
            [['student_id', 'student_type_id', 'financial_year_id', 'class_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'student_financial_year_id' => 'Student Financial Year ID',
            'student_id' => 'Student ID',
            'student_type_id' => 'Student Type ID',
            'financial_year_id' => 'Financial Year ID',
            'class_id' => 'Class ID',
        ];
    }
}
