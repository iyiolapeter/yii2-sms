<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model pso\yii2\sms\models\SmsProvider */

$this->title = 'Update Sms Provider: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Sms Providers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sms-provider-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
