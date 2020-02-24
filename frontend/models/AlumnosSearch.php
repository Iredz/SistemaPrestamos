<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Alumnos;

/**
 * AlumnosSearch represents the model behind the search form of `frontend\models\Alumnos`.
 */
class AlumnosSearch extends Alumnos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['noControl'], 'integer'],
            [['alumnoNombre', 'alumnoCarreraNombre'], 'safe'],
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
        $query = Alumnos::find();

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
            'noControl' => $this->noControl,
        ]);

        $query->andFilterWhere(['like', 'alumnoNombre', $this->alumnoNombre])
            ->andFilterWhere(['like', 'alumnoCarreraNombre', $this->alumnoCarreraNombre]);

        return $dataProvider;
    }
}
