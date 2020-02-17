<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model pso\yii2\sms\models\SmsNotification */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sms Notifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sms-notification-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'provider_id',
            'reference',
            'tag',
            'phone_number',
            'text',
            'message_reference',
            'raw',
            'sms_count',
            'status',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
