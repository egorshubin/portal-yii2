<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Paper as PaperModel;

/**
 * PaperSearch represents the model behind the search form of `app\models\Paper`.
 */
class PaperSearch extends PaperModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'manager_id', 'status_id', 'arrangement', 'type_f', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'safe'],
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
        $query = PaperModel::find();

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
            'manager_id' => $this->manager_id,
            'status_id' => $this->status_id,
            'arrangement' => $this->arrangement,
            'type_f' => $this->type_f,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
