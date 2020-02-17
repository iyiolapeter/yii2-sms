<?php

namespace pso\yii2\sms\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use pso\yii2\sms\models\SmsProvider;

/**
 * SmsProviderSearch represents the model behind the search form of `pso\yii2\sms\models\SmsProvider`.
 */
class SmsProviderSearch extends SmsProvider
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'title', 'class', 'config', 'status', 'created_at', 'updated_at'], 'safe'],
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
        $query = SmsProvider::find();

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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'class', $this->class])
            ->andFilterWhere(['like', 'config', $this->config])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
