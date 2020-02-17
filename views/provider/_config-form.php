<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model pso\yii2\sms\models\SmsProvider */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sms-provider-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php foreach($model->attributes() as $attribute): ?>
        <?= $form->field($model, $attribute)->textInput(['maxlength' => true, 'readonly' => !$model->isAttributeSafe($attribute)]) ?>
    <?php endforeach; ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
