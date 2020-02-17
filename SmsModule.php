<?php

namespace pso\yii2\sms;

use pso\yii2\sms\models\SmsComponentInterface;

/**
 * sms module definition class
 */
class SmsModule extends \yii\base\Module
{
    public $sms = 'sms';
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'pso\yii2\sms\controllers';

    public $defaultRoute = 'notification';

    private $_sms;
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        $this->_sms = $this->get($this->sms, true);
        if(!($this->_sms instanceof SmsComponentInterface)){
            throw new \yii\base\InvalidCallException('Sms component must implement SmsComponentInterface');
        }
        // custom initialization code goes here
    }

    public function getHandlerComponent(){
        return $this->_sms;
    }
}
