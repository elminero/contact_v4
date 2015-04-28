<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'People';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Person', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'live',
            'last_name',
            'first_name',
            'middle_name',
            // 'alias_name',
            // 'birth_month',
            // 'birth_day',
            // 'birth_year',
            // 'note:ntext',
            // 'user_id_created',
            // 'date_created',
            // 'date_updated',
            // 'ip_created',
            // 'ip_updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
