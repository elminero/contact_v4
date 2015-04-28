<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\EmailAddress */

$this->title = 'Update Email Address: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Email Addresses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="email-address-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
