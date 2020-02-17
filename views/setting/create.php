<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model pso\yii2\sms\models\SmsSetting */

$this->title = 'Create Sms Setting';
$this->params['breadcrumbs'][] = ['label' => 'Sms Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sms-setting-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
