<?php

namespace pso\yii2\sms\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use pso\yii2\sms\models\SmsNotification;

/**
 * SmsNotificationSearch represents the model behind the search form of `pso\yii2\sms\models\SmsNotification`.
 */
class SmsNotificationSearch extends SmsNotification
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'provider_id', 'sms_count'], 'integer'],
            [['reference', 'tag', 'phone_number', 'text', 'message_reference', 'raw', 'status', 'created_at', 'updated_at'], 'safe'],
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
        $query = SmsNotification::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC 
                ]
            ],
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
            'provider_id' => $this->provider_id,
            'sms_count' => $this->sms_count,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'reference', $this->reference])
            ->andFilterWhere(['like', 'tag', $this->tag])
            ->andFilterWhere(['like', 'phone_number', $this->phone_number])
            ->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'message_reference', $this->message_reference])
            ->andFilterWhere(['like', 'raw', $this->raw])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
