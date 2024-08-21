<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Halls;

/**
 * HallsSearch represents the model behind the search form of `app\models\Halls`.
 */
class HallsSearch extends Halls
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'capacity'], 'integer'],
            [['hall_name', 'hall_description'], 'safe'],
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
        $query = Halls::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'capacity' => $this->capacity,
        ]);

        $query->andFilterWhere(['like', 'hall_name', $this->hall_name])
            ->andFilterWhere(['like', 'hall_description', $this->hall_description]);

        return $dataProvider;
    }
}
