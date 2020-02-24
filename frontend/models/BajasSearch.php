<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Bajas;

/**
 * BajasSearch represents the model behind the search form of `frontend\models\Bajas`.
 */
class BajasSearch extends Bajas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bajaID', 'matID'], 'integer'],
            [['descrMat', 'razon', 'bajaFecha'], 'safe'],
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
        $query = Bajas::find();

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
            'bajaID' => $this->bajaID,
            'matID' => $this->matID,
            'bajaFecha' => $this->bajaFecha,
        ]);

        $query->andFilterWhere(['like', 'descrMat', $this->descrMat])
            ->andFilterWhere(['like', 'razon', $this->razon]);

        return $dataProvider;
    }
}
