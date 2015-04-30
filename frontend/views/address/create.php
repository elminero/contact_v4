<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Address */

$this->title = 'Add a New Address';
$this->params['breadcrumbs'][] = ['label' => 'List', 'url' => ['person/list']];
$this->params['breadcrumbs'][] = ['label' => 'Profile ' . $model->person_id, 'url' => ['person/profile', 'id' => $model->person_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="address-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
