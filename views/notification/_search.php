<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model pso\yii2\sms\models\search\SmsNotificationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sms-notification-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'provider_id') ?>

    <?= $form->field($model, 'reference') ?>

    <?= $form->field($model, 'tag') ?>

    <?= $form->field($model, 'phone_number') ?>

    <?php // echo $form->field($model, 'text') ?>

    <?php // echo $form->field($model, 'message_reference') ?>

    <?php // echo $form->field($model, 'raw') ?>

    <?php // echo $form->field($model, 'sms_count') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
