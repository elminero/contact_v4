<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Picture */

$this->title = 'Upload Picture';
$this->params['breadcrumbs'][] = ['label' => 'List', 'url' => ['person/list']];
$this->params['breadcrumbs'][] = ['label' => 'Profile ' . $model->person_id, 'url' => ['person/profile', 'id' => $model->person_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="picture-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
