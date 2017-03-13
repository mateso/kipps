<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contacts".
 *
 * @property integer $id
 * @property integer $contact_type
 * @property integer $student_id
 * @property string $contact_first_name
 * @property string $contact_middle_name
 * @property string $contact_surname
 * @property string $contact_occupation
 * @property string $contact_religion
 * @property string $contact_postal_address
 * @property string $contact_residential
 * @property string $contact_telephone
 * @property string $contact_mobile_phone
 * @property string $contact_office_phone
 *
 * @property User $student
 */
class KipsContacts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contacts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contact_type', 'student_id', 'contact_first_name', 'contact_surname', 'contact_occupation'], 'required'],
            [['student_id'], 'integer'],
            [['contact_first_name', 'contact_middle_name', 'contact_surname', 'contact_occupation', 'contact_religion', 'contact_postal_address', 'contact_residential', 'contact_telephone', 'contact_mobile_phone', 'contact_type','contact_office_phone'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'contact_type' => 'Contact Type',
            'student_id' => 'Student',
            'contact_first_name' => 'Contact First Name',
            'contact_middle_name' => 'Contact Middle Name',
            'contact_surname' => 'Contact Surname',
            'contact_occupation' => 'Contact Occupation',
            'contact_religion' => 'Contact Religion',
            'contact_postal_address' => 'Contact Postal Address',
            'contact_residential' => 'Contact Residential',
            'contact_telephone' => 'Contact Telephone',
            'contact_mobile_phone' => 'Contact Mobile Phone',
            'contact_office_phone' => 'Contact Office Phone',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(User::className(), ['userid' => 'student_id']);
    }
    
    public static function getContactName($student_id) {
       $model = self::findOne(['student_id' => $student_id]);
       $contact_name = $model->contact_first_name.' ' .$model->contact_middle_name.' '.$model->contact_surname;
       return $contact_name;
    }
}