<?php

use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel pso\yii2\sms\models\search\SmsNotificationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sms Notifications';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sms-notification-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'provider.title',
                'label' => 'Provider'
            ],
            //'reference',
            'tag',
            'phone_number',
            'text',
            //'message_reference',
            'raw',
            'sms_count',
            'status',
            'created_at',
            //'updated_at',

            // [
            //     'class' => 'yii\grid\ActionColumn',
            //     'template' => '{resend}',
            //     'buttons' => [
            //         'resend' => function($index, $model){
            //             if($model->status === 'failed'){
            //                 return Html::a('Resend',['resend', 'id' => $model->id],['data-method'=> 'POST']);
            //             }
            //             return '';
            //         }
            //     ]
            // ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
