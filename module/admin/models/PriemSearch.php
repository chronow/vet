<?php

namespace app\module\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\module\admin\models\Priem;

/**
 * PriemSearch represents the model behind the search form about `app\module\admin\models\Priem`.
 */
class PriemSearch extends Priem
{   public $fullName;
    public $phoneNumber;
    public $animalsName;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_users', 'id_pets', 'id_type_animals'], 'integer'],
            [['date', 'time', 'sostoyanie', 'anamnez', 'diagnoz', 'naznachenie', 'fullName', 'phoneNumber', 'animalsName'], 'safe'],
            [['summ'], 'number'],
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
        $query = Priem::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        /**
         * Настройка параметров сортировки
         * Важно: должна быть выполнена раньше $this->load($params)
         */
        $dataProvider->setSort([
            'attributes' => [
                'id',
                'fullName' => [
                    'asc' => ['users.name' => SORT_ASC],
                    'desc' => ['users.name' => SORT_DESC],
                    'label' => 'ФИО Владельца'
                ],
                'phoneNumber' => [
                    'asc' => ['users.phone' => SORT_ASC],
                    'desc' => ['users.phone' => SORT_DESC],
                    'label' => 'Телефон Владельца'
                ],
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
            'date' => $this->date,
            'id_type_animals' => $this->id_type_animals,
            'summ' => $this->summ,
        ]);

        $query->andFilterWhere(['like', 'time', $this->time])
            ->andFilterWhere(['like', 'sostoyanie', $this->sostoyanie])
            ->andFilterWhere(['like', 'anamnez', $this->anamnez])
            ->andFilterWhere(['like', 'diagnoz', $this->diagnoz])
            ->andFilterWhere(['like', 'naznachenie', $this->naznachenie]);
        
        // Фильтр по users
        $query->joinWith(['nameClientsFunc' => function ($q) {
            $q->where('users.name LIKE "%' . $this->fullName . '%"');
            $q->where('users.phone LIKE "%' . $this->phoneNumber . '%"');
        }, 
        
        ]);
        

        return $dataProvider;
    }
}
