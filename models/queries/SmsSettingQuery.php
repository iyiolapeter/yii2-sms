<?php

namespace pso\yii2\sms\models\queries;

/**
 * This is the ActiveQuery class for [[\pso\yii2\sms\models\SmsSetting]].
 *
 * @see \pso\yii2\sms\models\SmsSetting
 */
class SmsSettingQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \pso\yii2\sms\models\SmsSetting[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \pso\yii2\sms\models\SmsSetting|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
