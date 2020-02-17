<?php

namespace pso\yii2\sms\components\providers;

use pso\yii2\sms\components\providers\BaseProvider;
use pso\yii2\sms\models\SmsProvider;
use pso\yii2\sms\models\SmsResponse;

class Infobip extends BaseProvider
{
    const BASE_URL = "https://api.infobip.com/";
    const SEND_SMS_URL = "sms/1/text/single";
    const LOOKUP_RECIPIENT_URL = "number/1/query";
    const CHECK_BALANCE_URL = "api/command";
    const REJECTED_GRP_CODES = [5];

    public function init()
    {
        $this->base_url = SELF::BASE_URL;
        parent::init();
    }

    public function getName(): string {
        return SmsProvider::PROVIDER_INFOBIP;
    }

    public function beforeRequest($event)
    {
        $event->request->addHeaders([
            'Authorization' => "App $this->api_key"
        ]);
    }

    public function send(string $recipient, string $message): SmsResponse{
        $response = $this->sendRequest('POST', SELF::SEND_SMS_URL, [
            'from' => $this->getSenderId(),
            'to' => $recipient,
            'text' => $message 
        ]);
        $code = $response->getStatusCode();
        $status = false;
        $data = $response->getData();
        $message_reference = NULL;
        $sms_count = 0;
        if($this->isSent($data)){
            $status = true;
            $message_reference = $data['messages'][0]['messageId'];
            $sms_count = $data['messages'][0]['smsCount'];
        }
        $sms = new SmsResponse([
            'provider' => SmsProvider::PROVIDER_INFOBIP,
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
        if(!isset($data['messages']) || !is_array($data['messages'])){
            return false;
        }
        $node = $data['messages'][0];
        if(empty($node) || empty($node['status']) || empty($node['status']['groupId'])){
            return false;
        }
        $group_id = $node['status']['groupId'];
        if(!$group_id || in_array($group_id, SELF::REJECTED_GRP_CODES)){
            return false;
        }
        return true;
    }
}