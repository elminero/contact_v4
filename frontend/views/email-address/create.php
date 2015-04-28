<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\EmailAddress */

$this->title = 'Create Email Address';
$this->params['breadcrumbs'][] = ['label' => 'Email Addresses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="email-address-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
