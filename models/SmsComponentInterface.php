<?php

namespace pso\yii2\sms\models;

use pso\yii2\sms\models\SmsProvider;
use pso\yii2\sms\models\SmsResponse;
use pso\yii2\sms\models\SmsProviderInterface;

interface SmsComponentInterface
{
    public function enabled(): bool;
    public function loadProviderHandler(SmsProvider $model, $validate = true): SmsProviderInterface;
    public function getActiveProvider(): SmsProviderInterface;
    public function send(string $recipient, string $message): SmsResponse;
}