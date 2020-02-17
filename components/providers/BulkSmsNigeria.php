<?php

namespace pso\yii2\sms\components\providers;

use pso\yii2\sms\components\providers\BaseProvider;
use pso\yii2\sms\models\SmsProvider;
use pso\yii2\sms\models\SmsResponse;
use yii\httpclient\Client;

class BulkSmsNigeria extends BaseProvider
{
    const BASE_URL = "https://www.bulksmsnigeria.com/";
    const SEND_SMS_URL = "api/v1/sms/create";

    public $dnd_mode = 4;

    public function init()
    {
        $this->base_url = SELF::BASE_URL;
        parent::init();
    }

    public function getName(): string {
        return SmsProvider::PROVIDER_BULKSMSNIGERIA;
    }

    public function rules(){
        $rules = parent::rules();
        $rules[] = ['dnd_mode','required'];
        $rules[] = ['dnd_mode','integer', 'min' => 1, 'max' => 5];
        return $rules;
    }

    public function send(string $recipient, string $message): SmsResponse{
        $response = $this->sendRequest('POST', SELF::SEND_SMS_URL, [
            'api_token' => $this->api_key,
            'from' => $this->getSenderId(),
            'to' => $recipient,
            'body' => $message,
            'dnd' => $this->dnd_mode 
        ], Client::FORMAT_RAW_URLENCODED);
        $code = $response->getStatusCode();
        $status = false;
        $data = $response->getData();
        $message_reference = NULL;
        $sms_count = 0;
        if($this->isSent($data)){
            $status = true;
            $message_reference = (string)\microtime();
            $sms_count = 0;
        }
        $sms = new SmsResponse([
            'provider' => SmsProvider::PROVIDER_BULKSMSNIGERIA,
            'status' => $status,
            'code' => $code,
            'message_reference' => $message_reference,
            'sms_count' => $sms_count,
            'raw' => json_encode($data)
        ]);
        if($this->model){
            $sms->provider_id = $this->model->id;
        }
        return $sms;
    }

    public function isSent($data){
        if(!isset($data['data']) || !is_array($data['data'])){
            return false;
        }
        $node = $data['data'];
        if(empty($node) || empty($node['status'])){
            return false;
        }
        return $node['status'] === 'success';
    }
}