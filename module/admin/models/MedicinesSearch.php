<?php

namespace app\module\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\module\admin\models\Medicines;

/**
 * MedicinesSearch represents the model behind the search form about `app\module\admin\models\Medicines`.
 */
class MedicinesSearch extends Medicines
{   
    public $titleMedicines;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_group_medicines', 'id_suppliers', 'in_stock'], 'integer'],
            [['title', 'unit_type', 'date_start', 'titleMedicines', 'date_finished'], 'safe'],
            [['received', 'price', 'all_price', 'price_retail'], 'number'],
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
        $query = Medicines::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->setSort([
            'attributes' => [
                'titleMedicines' => [
                    'asc' => ['group_medicines.name' => SORT_ASC],
                    'desc' => ['group_medicines.name' => SORT_DESC],
                    'label' => 'Группа медикаментов'
                ]
            ]
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
            'id_group_medicines' => $this->id_group_medicines,
            'id_suppliers' => $this->id_suppliers,
            'in_stock' => $this->in_stock,
            'received' => $this->received,
            'price' => $this->price,
            'all_price' => $this->all_price,
            'price_retail' => $this->price_retail,
            'date_start' => $this->date_start,
            'date_finished' => $this->date_finished,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'unit_type', $this->unit_type]);
        
        // НАШ Фильтр
        $query->joinWith(['dataGroupMedicines' => function ($q) {
            $q->where('group_medicines.name LIKE "%' . $this->titleMedicines . '%"');
        }]);
        
        return $dataProvider;
    }
    
    
    
    /**
     * ОСТАТКИ
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search2($params)
    {
        $query = Medicines::find()->where("received < 20 ");

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
            'id_group_medicines' => $this->id_group_medicines,
            'id_suppliers' => $this->id_suppliers,
            'in_stock' => $this->in_stock,
            'received' => $this->received,
            'price' => $this->price,
            'all_price' => $this->all_price,
            'price_retail' => $this->price_retail,
            'date_start' => $this->date_start,
            'date_finished' => $this->date_finished,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'unit_type', $this->unit_type]);

        return $dataProvider;
    }
    
    /**
     * Просроченно
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search3($params)
    {
        $query = Medicines::find()->where("date_finished <= '".date('Y-m-d')."' ");

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
            'id_group_medicines' => $this->id_group_medicines,
            'id_suppliers' => $this->id_suppliers,
            'in_stock' => $this->in_stock,
            'received' => $this->received,
            'price' => $this->price,
            'all_price' => $this->all_price,
            'price_retail' => $this->price_retail,
            'date_start' => $this->date_start,
            'date_finished' => $this->date_finished,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'unit_type', $this->unit_type]);

        return $dataProvider;
    }
}
