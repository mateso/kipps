<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kips_education_level".
 *
 * @property integer $id
 * @property string $education_level
 * @property string $description
 *
 * @property KipsPaymentSetup[] $kipsPaymentSetups
 */
class KipsEducationLevel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'education_level';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['education_level', 'description'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'education_level' => 'Education Level',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKipsPaymentSetups()
    {
        return $this->hasMany(KipsPaymentSetup::className(), ['education_level_id' => 'id']);
    }
}
