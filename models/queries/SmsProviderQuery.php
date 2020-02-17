<?php

namespace pso\yii2\sms\models\queries;

/**
 * This is the ActiveQuery class for [[\pso\yii2\sms\models\SmsProvider]].
 *
 * @see \pso\yii2\sms\models\SmsProvider
 */
class SmsProviderQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \pso\yii2\sms\models\SmsProvider[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \pso\yii2\sms\models\SmsProvider|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
