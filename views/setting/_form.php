<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use pso\yii2\sms\models\SmsProvider;
use pso\yii2\sms\models\SmsSetting;

/* @var $this yii\web\View */
/* @var $model pso\yii2\sms\models\SmsSetting */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sms-setting-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php if($model->name === SmsSetting::SMS_SETTING_ACTIVE_PROVIDER): ?>
        <?= $form->field($model, 'value')->dropdownList(SmsProvider::fetchOptions(), ['prompt' => 'Select an option']) ?>
    <?php elseif($model->name === SmsSetting::SMS_SETTING_ENABLED): ?>
        <?= $form->field($model, 'value')->checkbox(['label' => 'Enable SMS?']) ?>
    <?php else: ?>
        <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>
    <?php endif; ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
