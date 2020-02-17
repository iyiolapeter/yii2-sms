<?php

namespace pso\yii2\sms\models;

use yii\base\Model;

class SmsResponse extends Model {

    public $provider;
    public $provider_id;
    public $status = false;
    public $code;
    public $message_reference;
    public $sms_count;
    public $raw;
}