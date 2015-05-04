<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\PhoneNumber */

$this->title = 'Update Phone Number: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'List', 'url' => ['person/list']];
$this->params['breadcrumbs'][] = ['label' => "Profile " . $model->person_id, 'url' => ['person/profile', 'id' => $model->person_id]];
$this->params['breadcrumbs'][] = $this->title;

$this->params['breadcrumbs'][] = ['label' => 'delete', 'url' => ['phone-number/remove' , 'id' => $model->id ],
    'template' => '<li style="float: right;">{link}</li>'];

?>
<div class="phone-number-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
