<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Picture */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="picture-form" >

    <?php $form = ActiveForm::begin([

        //       'type' => ActiveForm::TYPE_HORIZONTAL,
        //       'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL],

        'options' => ['enctype' => 'multipart/form-data', ]]) ?>

    <div class="col-sm-4">


        <?= $form->field($model, 'file_name')->fileInput() ?>

        <?= $form->field($model, 'avatar')->checkbox() ?>
    </div>


    <div class="col-sm-5">
        <?= $form->field($model, 'caption')->textarea(['rows' => 3]) ?>

        <?= $form->field($model, 'copyright')->textInput()  ?>

        <div style="float: right">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

    </div>

    <?php ActiveForm::end(); ?>

    <div style="clear: both"></div>

</div>
