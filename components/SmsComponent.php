<?php

namespace pso\yii2\sms\components;

use Yii;
use yii\base\Component;
use pso\yii2\sms\models\SmsSetting;
use pso\yii2\sms\models\SmsProvider;
use pso\yii2\sms\models\SmsResponse;
use yii\base\InvalidConfigException;
use pso\yii2\sms\models\SmsProviderInterface;
use pso\yii2\sms\models\SmsComponentInterface;
use pso\yii2\sms\components\providers\BaseProvider;

class SmsComponent extends Component implements SmsComponentInterface
{
    private $activeProvider;

    public $sender_id;

    public $providers = [];

    public function enabled(): bool {
        return !empty(SmsSetting::fetch(SmsSetting::SMS_SETTING_ENABLED, true));
    }

    public function loadProviderHandler(SmsProvider $model, $validate = true): SmsProviderInterface {
        $config['sender_id'] = $this->sender_id;
        $config = array_merge($config, $this->providers[$model->name]??[], $model->config?:[]);
        $config['class'] = $model->class;
        $handler = Yii::createObject($config);
        if(!$handler instanceof BaseProvider || ($validate && !$handler->validate())){
            throw new InvalidConfigException('Provider class is not properly configured');
        }
        $handler->setModel($model);
        return $handler;
    }

    /**
     * @return pso\yii2\sms\components\providers\BaseProvider
     */
    public function getActiveProvider(): SmsProviderInterface {
        if(!isset($this->activeProvider)){
            $model = SmsProvider::active();
            if(is_null($model)){
                throw new InvalidConfigException('Please ensure there is an active provider');
            }
            $handler = $this->loadProviderHandler($model);
            $this->activeProvider = $handler;
        }
        return $this->activeProvider;
    }

    public function send(string $recipient, string $message): SmsResponse {
        $provider = $this->getActiveProvider();
        if(!$this->enabled()){
            $sms =  new SmsResponse([
                'status' => false,
                'provider' => $provider->name,
                'raw' => 'Platform SMS Disabled!'
            ]);
            if($provider->model){
                $sms->provider_id = $provider->model->id;
            }
            return $sms;
        }
        return $provider->send($recipient, $message);
    }
}