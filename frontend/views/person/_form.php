<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Person */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="person-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'middle_name')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'alias_name')->textInput(['maxlength' => 30] ) ?>

    <?= $form->field($model, 'birth_month')->dropDownList( $model->getMonthOptions()) ?>

    <?= $form->field($model, 'birth_day')->dropDownList( $model->getDayOptions()  ) ?>

    <?= $form->field($model, 'birth_year')->dropDownList( $model->getYearOptions(), array('width'=>30) ) ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
