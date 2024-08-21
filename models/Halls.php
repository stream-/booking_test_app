<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "halls".
 *
 * @property int $id
 * @property string $hall_name
 * @property string|null $hall_description
 * @property int|null $capacity
 *
 * @property BookingData $bookingData
 */
class Halls extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'halls';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hall_name'], 'required'],
            [['hall_description'], 'string'],
            [['capacity'], 'integer'],
            [['hall_name'], 'string', 'max' => 128],
            [['hall_name'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'hall_name' => Yii::t('app', 'Hall Name'),
            'hall_description' => Yii::t('app', 'Hall Description'),
            'capacity' => Yii::t('app', 'Capacity'),
        ];
    }

    /**
     * Gets query for [[BookingData]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBookingData()
    {
        return $this->hasOne(BookingData::class, ['hall_id' => 'id']);
    }
}
