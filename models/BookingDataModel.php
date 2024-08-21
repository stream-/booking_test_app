<?php

namespace app\models;

use Yii;
use app\models\BookingData;

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
class BookingDataModel extends BookingData
{
    public $hall_name;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return parent::tableName();
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
            //[['hall_id'], 'unique'],
            //[['user_id'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['user_id' => 'id']],
            [['hall_id'], 'exist', 'skipOnError' => true, 'targetClass' => Halls::class, 'targetAttribute' => ['hall_id' => 'id']],
            [['hall_name'], 'safe'],
            [['hall_name'], 'isHallAvailable'],
            [['hall_name', 'booking_begin', 'booking_end'], 'required'],
            [['hall_name'], 'customUnique']
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

    public function isHallAvailable($attribute, $params) {
        $hall = HallsModel::find()->joinWith('bookingData')
        ->filterWhere(['>=', 'booking_begin', $this->booking_begin])
        ->andFilterWhere(['<=', 'booking_end', $this->booking_end])
        ->andWhere(['like', 'hall_name',  $this->hall_name])
        ->andWhere('hall_id = halls.id')
        ->asArray()->one();
        if ($hall) {
            $this->addError('hall_name', 'Hall not available for booking');
        }
    }

    public function customUnique($attribute, $params) {
        $book_data = HallsModel::find()->joinWith('bookingData')->where([
            'user_id' => Yii::$app->user->id,
        ])
        ->andWhere(['like', 'hall_name',  $this->hall_name])
        ->andWhere('hall_id = halls.id')->one();
        if ($book_data) {
            $this->addError('hall_name', 'You have already booked this hall');
        }
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
