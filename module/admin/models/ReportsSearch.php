<?php

namespace app\module\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\module\admin\models\Reports;

/**
 * ReportsSearch represents the model behind the search form about `app\module\admin\models\Reports`.
 */
class ReportsSearch extends Reports
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_priem'], 'integer'],
            [['date', 'time', 'note'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Reports::find();

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
            'id_priem' => $this->id_priem,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'time', $this->time])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
