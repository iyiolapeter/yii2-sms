<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model pso\yii2\sms\models\SmsNotification */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sms-notification-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'provider_id')->textInput() ?>

    <?= $form->field($model, 'reference')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tag')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'message_reference')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'raw')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sms_count')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([ 'pending' => 'Pending', 'processed' => 'Processed', 'completed' => 'Completed', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
