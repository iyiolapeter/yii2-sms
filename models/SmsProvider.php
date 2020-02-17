<?php

namespace pso\yii2\sms\models;

use Yii;
use pso\yii2\sms\models\SmsSetting;
use pso\yii2\sms\components\providers\BaseProvider;
use pso\yii2\sms\SmsModule;
use ReflectionClass;

/**
 * This is the model class for table "{{%sms_provider}}".
 *
 * @property int $id
 * @property string $name
 * @property string $title
 * @property string $class
 * @property array $config
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property SmsNotification[] $smsNotifications
 */
class SmsProvider extends \yii\db\ActiveRecord
{
    const PROVIDER_INFOBIP = 'infobip';
    const PROVIDER_BULKSMSNIGERIA = 'bulksmsnigeria';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sms_provider}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'title', 'class'], 'required'],
            [['class'], 'validateClass'],
            [['config', 'created_at', 'updated_at'], 'safe'],
            [['status'], 'string'],
            [['name', 'title', 'class'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    public function validateClass($attribute){
        if(!class_exists($this->$attribute)){
            return $this->addError($attribute, 'Handler class does not exist');
        }
        $reflection  = new ReflectionClass($this->$attribute);
        if(!$reflection->isSubclassOf(BaseProvider::className())){
            return $this->addError($attribute, 'Handler class does not extend BaseProvider');
        }
        return NULL;
    }

    public function getConfigModel(SmsModule $module){
        return $module->getHandlerComponent()->loadProviderHandler($this, false);
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
            'class' => 'Class',
            'config' => 'Config',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSmsNotifications()
    {
        return $this->hasMany(SmsNotification::className(), ['provider_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \pso\yii2\sms\models\queries\SmsProviderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \pso\yii2\sms\models\queries\SmsProviderQuery(get_called_class());
    }

    public static function active(){
        $provider = SmsSetting::fetch(SmsSetting::SMS_SETTING_ACTIVE_PROVIDER);
        if(is_null($provider)){
            return NULL;
        }
        return static::find()->where(['name' => $provider])->cache()->one();
    }

    public static function fetchOptions()
    {
        return static::find()->select(['title'])->indexBy('name')->column();
    }
}
