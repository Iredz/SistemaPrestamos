<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Inventario;

/**
 * InventarioSearch represents the model behind the search form of `frontend\models\Inventario`.
 */
class InventarioSearch extends Inventario
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['matID'], 'integer'],
            [['descrMat', 'marca', 'modelo', 'serie', 'noInventario', 'estatus'], 'safe'],
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
        $query = Inventario::find();

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
            'matID' => $this->matID,
        ]);

        $query->andFilterWhere(['like', 'descrMat', $this->descrMat])
            ->andFilterWhere(['like', 'marca', $this->marca])
            ->andFilterWhere(['like', 'modelo', $this->modelo])
            ->andFilterWhere(['like', 'serie', $this->serie])
            ->andFilterWhere(['like', 'noInventario', $this->noInventario])
            ->andFilterWhere(['like', 'estatus', $this->estatus]);

        return $dataProvider;
    }
}
