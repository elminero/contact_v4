<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Addresses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="address-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Address', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'person_id',
            'live',
            'type',
            'iso',
            // 'state',
            // 'street',
            // 'city',
            // 'postal_code',
            // 'note:ntext',
            // 'user_id_created',
            // 'date_entered',
            // 'date_updated',
            // 'ip_created',
            // 'ip_updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
