<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kips_attachments".
 *
 * @property integer $id
 * @property integer $student_id
 * @property string $attchment_type
 * @property string $attchment
 *
 * @property KipsUsers $student
 */
class KipsAttachments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kips_attachments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'student_id'], 'required'],
            [['id', 'student_id'], 'integer'],
            [['attchment_type', 'attchment'], 'string']
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
            'attchment_type' => 'Attchment Type',
            'attchment' => 'Attchment',
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
