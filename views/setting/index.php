<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel pso\yii2\sms\models\search\SmsSettingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sms Settings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sms-setting-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'name',
            'title',
            'value',
            'created_at',
            //'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}'
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
