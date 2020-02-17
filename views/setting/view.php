<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model pso\yii2\sms\models\SmsSetting */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Sms Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sms-setting-view">
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'title',
            'value',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
