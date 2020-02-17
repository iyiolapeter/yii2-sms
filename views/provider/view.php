<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model pso\yii2\sms\models\SmsProvider */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Sms Providers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sms-provider-view">
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        
        <?= Html::a($model->status === 'enabled'?'Disable':'Enable', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-'.($model->status === 'enabled'?'warning':'success'),
            'data' => [
                'confirm' => 'Are you sure you want to '.($model->status === 'enabled'?'disable':'enable').' this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="row">
        <div class="col-md-6">
            <?= DetailView::widget([
                'model' => $model,
                'options' => ['class' => 'table table-striped table-bordered detail-view table-responsive'],
                'attributes' => [
                    'id',
                    'name',
                    'title',
                    'class',
                    [
                        'attribute' => 'config',
                        'value' => function($model){
                            return json_encode($model->config);
                        }
                    ],
                    'status',
                    'created_at',
                    'updated_at',
                ],
                ]) 
            ?>
        </div>
        <div class="col-md-6">
            <h5>Provider Configuration</h5>
            <?= $this->render('_config-form', [
                'model' => $configModel,
            ]) ?>
        </div>
    </div>

</div>
