<?php

namespace pso\yii2\sms\models;

use pso\yii2\sms\models\SmsResponse;

interface SmsProviderInterface
{
    public function send(string $recipient, string $message): SmsResponse;
    public function getName(): string;
}