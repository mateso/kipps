<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kips_payment_types".
 *
 * @property integer $id
 * @property string $payment_type
 * @property string $description
 *
 * @property KipsPaymentSetup[] $kipsPaymentSetups
 */
class KipsPaymentTypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment_types';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['payment_type', 'description'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'payment_type' => 'Payment Type',
            'description' => 'Description',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKipsPaymentSetups()
    {
        return $this->hasMany(KipsPaymentSetup::className(), ['payment_type_id' => 'id']);
    }
}
