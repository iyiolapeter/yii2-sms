<?php

namespace pso\yii2\sms\models;

use Yii;
use yii\caching\CacheInterface;
use yii\caching\TagDependency;

/**
 * This is the model class for table "{{%sms_setting}}".
 *
 * @property int $id
 * @property string $name
 * @property string $title
 * @property string $value
 * @property string $created_at
 * @property string $updated_at
 */
class SmsSetting extends \yii\db\ActiveRecord
{
    const SMS_SETTING_ACTIVE_PROVIDER = 'sms_active_provider';
    const SMS_SETTING_ENABLED = 'sms_enabled';

    const CACHE_DURATION = 3600;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sms_setting}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'title', 'value'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'title', 'value'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'title' => 'Title',
            'value' => 'Value',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \pso\yii2\sms\models\queries\SmsSettingQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \pso\yii2\sms\models\queries\SmsSettingQuery(get_called_class());
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if(!$insert){
            if(Yii::$app->has('cache') && Yii::$app->cache instanceof CacheInterface){
                TagDependency::invalidate(Yii::$app->cache, ['cache-sms-setting']);
            }
        }
    }

    public static function fetch($name, $refresh = false){
        $query = SELF::find()->where(['name' => $name])->select(['value']);
        if($refresh){
            return $query->scalar();
        }
        return $query->cache(SELF::CACHE_DURATION, new TagDependency(['tags'=>['cache-sms-setting']]))->scalar();
    }
}
