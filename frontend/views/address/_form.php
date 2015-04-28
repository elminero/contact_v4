<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Address */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="address-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'person_id')->textInput() ?>

    <?= $form->field($model, 'live')->textInput() ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'iso')->textInput(['maxlength' => 2]) ?>

    <?= $form->field($model, 'state')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'street')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'postal_code')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'user_id_created')->textInput() ?>

    <?= $form->field($model, 'date_entered')->textInput() ?>

    <?= $form->field($model, 'date_updated')->textInput() ?>

    <?= $form->field($model, 'ip_created')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'ip_updated')->textInput(['maxlength' => 50]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
