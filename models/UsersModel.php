<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $firstname
 * @property string $middlename
 * @property string $lastname
 * @property string $email
 * @property string $password
 * @property string|null $user_type
 * @property string|null $auth_key
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * 
 * 
 */
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
class UsersModel extends Users implements IdentityInterface
{
    public $password_repeat;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['firstname', 'lastname', 'email', 'password', 'password_repeat'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['firstname'], 'string', 'max' => 32],
            [['middlename', 'lastname', 'email'], 'string', 'max' => 64],
            ['email', 'email'],
            ['email', 'unique'],
            [['password', 'user_type'], 'string', 'max' => 120],
            [['auth_key'], 'string', 'max' => 100],
            [['password', 'password_repeat'], 'compare', 'compareAttribute'=>'password']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'firstname' => Yii::t('app', 'Firstname'),
            'middlename' => Yii::t('app', 'Middlename'),
            'lastname' => Yii::t('app', 'Lastname'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
            'user_type' => Yii::t('app', 'User Type'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Finds an identity by the given ID.
     *
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string|null current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return bool|null if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function generateAuthKey()
    {
        return $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function validatePassword($password) {
        return Yii::$app->security->validatePassword($password, $this->password);
    }
    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        
        if (self::findOne(['email' => $email])) {
            $user = self::findOne(['email' => $email]);
            return $user;
        }

        return null;
    }
}
