<?php

namespace pso\yii2\sms\components\providers;

use pso\yii2\sms\models\SmsProvider;
use pso\yii2\sms\models\SmsProviderInterface;
use yii\base\InvalidCallException;
use yii\httpclient\Client;
use yii\base\Model;

abstract class BaseProvider extends Model implements SmsProviderInterface
{

    private $client;

    public $base_url;
    public $sender_id;
    public $api_key;

    private $model_id;

    abstract public function getName():string;

    protected $model;

    public function init()
    {
        parent::init();
        $this->client = new Client(array_merge([
            'baseUrl' => $this->base_url, 
            'transport' => 'yii\httpclient\CurlTransport'
        ],$this->clientOptions()));
        $this->client->on(Client::EVENT_BEFORE_SEND, [$this, 'beforeRequest']);
    }

    public function clientOptions(){
        return [];
    }

    public function beforeRequest($event){
        return;
    }

    public function setModel(SmsProvider $model){
        $this->model = $model;
    }

    public function getModel(){
        return $this->model;
    }


    public function rules()
    {
        return [
            ['api_key','required'],
            ['sender_id', 'safe']
        ];
    }

    public function update(){
        if(empty($this->model) || !$this->validate()){
            return false;
        }
        $this->model->config = array_merge($this->model->config?:[], $this->getAttributes($this->activeAttributes()));
        return $this->model->save();
    }

    public function getSenderId(){
        if(empty($this->sender_id)){
            throw new InvalidCallException('Sender Id is not present');
        }
        if(\is_string($this->sender_id)){
            return $this->sender_id;
        }
        if(\is_callable($this->sender_id)){
            return \call_user_func($this->sender_id);
        }
        throw new InvalidCallException('No Sender Id configured');
    }

    public function sendRequest(string $method, string $endpoint, array $payload, $format = NULL) {
        return $this->client->createRequest()
                ->setMethod(strtoupper($method))
                ->setUrl($endpoint)
                ->setFormat($format?:Client::FORMAT_JSON)
                ->setData($payload)
                ->send();
    }
}