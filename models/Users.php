<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $firstname
 * @property string|null $middlename
 * @property string $lastname
 * @property string $email
 * @property string $password
 * @property string|null $user_type
 * @property string|null $auth_key
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property BookingData $bookingData
 */
class Users extends \yii\db\ActiveRecord
{
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
            [['firstname', 'lastname', 'email', 'password'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['firstname'], 'string', 'max' => 32],
            [['middlename', 'lastname', 'email'], 'string', 'max' => 64],
            [['password', 'user_type'], 'string', 'max' => 120],
            [['auth_key'], 'string', 'max' => 100],
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
     * Gets query for [[BookingData]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBookingData()
    {
        return $this->hasOne(BookingData::class, ['user_id' => 'id']);
    }
}
