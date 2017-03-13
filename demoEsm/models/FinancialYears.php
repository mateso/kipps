<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "FinancialYears".
 *
 * @property integer $YearID
 * @property string $FinancialYear
 * @property string $FYStart
 * @property string $FYEnd
 * @property integer $IsCurrent
 * @property integer $CoAVersionID
 * @property integer $AdminAreaVersionID
 * @property integer $PriorityAreaVersionID
 * @property integer $NationalTargetVersionID
 */
class FinancialYears extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'financial_years';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            
            [['YearID', 'IsCurrent', 'CoAVersionID', 'AdminAreaVersionID', 'PriorityAreaVersionID', 'NationalTargetVersionID'], 'integer'],
            [['CoAVersionID', 'AdminAreaVersionID', 'PriorityAreaVersionID', 'NationalTargetVersionID'], 'required'],
            [['FinancialYear'], 'string'],
            [['FYStart', 'FYEnd'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'YearID' => 'Year ID',
            'FinancialYear' => 'Academic Year',
            'FYStart' => 'Start Date',
            'FYEnd' => 'End Date',
            'IsCurrent' => 'Is Current',
            'CoAVersionID' => 'GFS Code Version',
            'AdminAreaVersionID' => 'Admin Area Version',
            'PriorityAreaVersionID' => 'Priority Area Version',
            'NationalTargetVersionID' => 'National Target Version',
        ];
    }
}
