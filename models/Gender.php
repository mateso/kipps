<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gender".
 *
 * @property integer $gender_id
 * @property string $desc_en
 */
class Gender extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gender';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['desc_en'], 'required'],
            [['desc_en'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'gender_id' => 'Gender ID',
            'desc_en' => 'Desc En',
        ];
    }

    public static function getGenderDesc($gender_id) {
        $model = self::findOne(['gender_id' => $gender_id]);
        return $model->desc_en;
    }
}
