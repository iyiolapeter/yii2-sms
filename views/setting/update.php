<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model pso\yii2\sms\models\SmsSetting */

$this->title = 'Update Sms Setting: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Sms Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sms-setting-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
