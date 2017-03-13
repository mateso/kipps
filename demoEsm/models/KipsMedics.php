<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kips_medics".
 *
 * @property integer $id
 * @property integer $student_id
 * @property string $medics
 *
 * @property KipsUsers $student
 */
class KipsMedics extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kips_medics';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'student_id'], 'required'],
            [['id', 'student_id'], 'integer'],
            [['medics'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'student_id' => 'Student ID',
            'medics' => 'Medics',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(KipsUsers::className(), ['id' => 'student_id']);
    }
}
