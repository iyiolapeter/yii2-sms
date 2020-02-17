<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model pso\yii2\sms\models\SmsNotification */

$this->title = 'Create Sms Notification';
$this->params['breadcrumbs'][] = ['label' => 'Sms Notifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sms-notification-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
