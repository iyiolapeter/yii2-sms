<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model pso\yii2\sms\models\SmsProvider */

$this->title = 'Create Sms Provider';
$this->params['breadcrumbs'][] = ['label' => 'Sms Providers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sms-provider-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
