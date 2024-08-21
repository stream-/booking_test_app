<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "booking_data".
 *
 * @property int $id
 * @property int $hall_id
 * @property int $user_id
 * @property string|null $booking_begin
 * @property string|null $booking_end
 * @property int|null $is_booked
 *
 * @property Halls $hall
 * @property Users $user
 */
class BookingData extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'booking_data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hall_id', 'user_id'], 'required'],
            [['hall_id', 'user_id', 'is_booked'], 'integer'],
            [['booking_begin', 'booking_end'], 'safe'],
            [['hall_id'], 'unique'],
            [['user_id'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['user_id' => 'id']],
            [['hall_id'], 'exist', 'skipOnError' => true, 'targetClass' => Halls::class, 'targetAttribute' => ['hall_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'hall_id' => Yii::t('app', 'Hall ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'booking_begin' => Yii::t('app', 'Booking Begin'),
            'booking_end' => Yii::t('app', 'Booking End'),
            'is_booked' => Yii::t('app', 'Is Booked'),
        ];
    }

    /**
     * Gets query for [[Hall]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHall()
    {
        return $this->hasOne(Halls::class, ['id' => 'hall_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }
}
