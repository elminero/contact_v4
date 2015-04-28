<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Person */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="person-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'live')->textInput() ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'middle_name')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'alias_name')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'birth_month')->textInput() ?>

    <?= $form->field($model, 'birth_day')->textInput() ?>

    <?= $form->field($model, 'birth_year')->textInput() ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'user_id_created')->textInput() ?>

    <?= $form->field($model, 'date_created')->textInput() ?>

    <?= $form->field($model, 'date_updated')->textInput() ?>

    <?= $form->field($model, 'ip_created')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'ip_updated')->textInput(['maxlength' => 50]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
