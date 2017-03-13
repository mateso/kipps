<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transport_routes".
 *
 * @property integer $id
 * @property integer $route_number
 * @property string $area_covered
 *
 * @property PaymentSetup[] $paymentSetups
 */
class KipsTransportRoutes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transport_routes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'route_number'], 'integer'],
            [['area_covered'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'route_number' => 'Route Number',
            'area_covered' => 'Area Covered',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentSetups()
    {
        return $this->hasMany(PaymentSetup::className(), ['transport_routes' => 'id']);
    }
}
