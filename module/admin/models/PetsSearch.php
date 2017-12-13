<?php

namespace app\module\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\module\admin\models\Pets;

/**
 * PetsSearch represents the model behind the search form about `app\module\admin\models\Pets`.
 */
class PetsSearch extends Pets
{   public $fullName;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_users', 'id_animals', 'id_type_animals'], 'integer'],
            [['name', 'fullName'], 'safe'],
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
        $query = Pets::find();

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
            ]
        ]);
        
        $this->load($params);

        if (!$this->validate()) {
            /**
             * Жадная загрузка данных модели Страны
             * для работы сортировки.
             */
            $query->joinWith(['users']);
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_users' => $this->id_users,
            'id_animals' => $this->id_animals,
            'id_type_animals' => $this->id_type_animals,
        ]);
        
        // Фильтр по users
        $query->joinWith(['nameClientsFunc' => function ($q) {
            $q->where('users.name LIKE "%' . $this->fullName . '%"');
        }]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
