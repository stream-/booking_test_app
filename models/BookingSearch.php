<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BookingDataModel;

/**
 * BookingSearch represents the model behind the search form of `app\models\BookingData`.
 */
class BookingSearch extends BookingDataModel
{
    public $hall_name;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'is_booked'], 'integer'],
            [['booking_begin', 'booking_end', 'hall_name'], 'safe'],
            //[['hall_name'],'string']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = BookingDataModel::find()->select(['hall_name', 'booking_begin', 'booking_end'])->joinWith('hall');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        
        // grid filtering conditions
        $query->andFilterWhere(['like', 'halls.hall_name' => $this->hall_name]);
        $query->andFilterWhere([
            'id' => $this->id,
            'user' => Yii::$app->user->identity->id,
            'booking_begin' => $this->booking_begin,
            'booking_end' => $this->booking_end,
            'is_booked' => $this->is_booked,
        ]);

        return $dataProvider;
    }
}
