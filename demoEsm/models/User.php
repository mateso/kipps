<?php

namespace app\models;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use Yii;

/**
 * This is the model class for table "User".
 *
 * @property integer $userid
 * @property string $username
 * @property string $password
 * @property string $firstname
 * @property string $middlename
 * @property string $lastname
 * @property string $email
 * @property string $phone
 * @property integer $status
 * @property integer $login_counts
 * @property string $last_login_date
 * @property integer $failed_login_attempts
 * @property string $last_password_update_date
 * @property string $auth_key
 * @property string $password_reset_token
 * @property string $created_at
 * @property integer $created_by
 *
 * @property AdminAreas $adminArea
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public $my_details;
    public $re_password;  
     
    public static function tableName()
    {
        return 'user';
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password','re_password', 'surname','firstname','email', 'phone'], 'required'],
            [['username', 'password', 'firstname','middlename','surname', 'email', 'phone', 'auth_key', 'password_reset_token','tittle'], 'string'],
            [['status', 'login_counts', 'failed_login_attempts', 'created_by'], 'integer'],
            [['email'], 'email'],
            ['re_password','compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match"],
            [['last_login_date', 'last_password_update_date', 'created_at','tittle','my_details'], 'safe']
        ];
    }
    

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userid' => 'Userid',
            'username' => 'Username',
            'password' => 'Password',
            're_password' => 'Confirm Password',
            'tittle' => 'Tittle',
            'firstname' => 'First Name',
            'middlename' => 'Middle Name',
            'surname' => 'Surname',
            'email' => 'Email',
            'phone' => 'Phone',
            'status' => 'Status',
            'login_counts' => 'Login Counts',
            'last_login_date' => 'Last Login Date',
            'failed_login_attempts' => 'Failed Login Attempts',
            'last_password_update_date' => 'Last Password Update Date',
            'auth_key' => 'Auth Key',
            'password_reset_token' => 'Password Reset Token',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'admin_level' => 'Admin Area Level',
        ];
    }

       /** INCLUDE USER LOGIN VALIDATION FUNCTIONS* */

    /**
     * @inheritdoc
     */
    public static function findIdentity($id) {
        return static::findOne($id);
    }


    /**
     * @inheritdoc
     */
    /* modified */
    public static function findIdentityByAccessToken($token, $type = null) {
        return static::findOne(['access_token' => $token]);
    }

    /* removed
      public static function findIdentityByAccessToken($token)
      {
      throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
      }
     */

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username) {
        return static::findOne(['username' => $username]);
    }

    /**
     * Finds user by password reset token
     *
     * @param  string      $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token) {
        $expire = \Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        if ($timestamp + $expire < time()) {
            // token expired
            return null;
        }

        return static::findOne([
                    'password_reset_token' => $token
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password) {
        return $this->password === sha1($password);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password) {
        $this->password_hash = Security::generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey() {
        $this->auth_key = Security::generateRandomKey();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken() {
        $this->password_reset_token = Security::generateRandomKey() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken() {
        $this->password_reset_token = null;
    }

    /** EXTENSION MOVIE * */
    
    /**
     * @return \yii\db\ActiveQuery
     */
    
    public function init() {
        parent::init();
        $this->my_details = [1=> Yii::$app->user->identity->username,2=> Yii::$app->user->identity->password]; 
    }
    
    public function getUserLevels()
    {
        return $this->hasMany(UserAdminAreaLevels::className(), ['userid' => 'userid']);
    }
}