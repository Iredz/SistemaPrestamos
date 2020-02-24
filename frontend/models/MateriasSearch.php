<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Materias;

/**
 * MateriasSearch represents the model behind the search form of `frontend\models\Materias`.
 */
class MateriasSearch extends Materias
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['materiaID'], 'integer'],
            [['materiaNombre'], 'safe'],
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
        $query = Materias::find();

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
            'materiaID' => $this->materiaID,
        ]);

        $query->andFilterWhere(['like', 'materiaNombre', $this->materiaNombre]);

        return $dataProvider;
    }
}
