<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Person */

$this->title = 'Update Person: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'List', 'url' => ['list']];
$this->params['breadcrumbs'][] = ['label' => "Profile " . $model->id, 'url' => ['profile', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;

$this->params['breadcrumbs'][] = ['label' => 'delete', 'url' => ['person/remove' , 'id' => $model->id ],
    'template' => '<li style="float: right;">{link}</li>'];

?>
<div class="person-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
