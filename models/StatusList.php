<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "status_list".
 *
 * @property integer $status_list_id
 * @property string $desc_en
 */
class StatusList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'status_list';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['desc_en'], 'required'],
            [['desc_en'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'status_list_id' => 'Status List ID',
            'desc_en' => 'Desc En',
        ];
    }

    public static function getStatusDesc($status_id) {
        $model = self::findOne(['status_list_id' => $status_id]);
        return $model->desc_en;
    }
}
