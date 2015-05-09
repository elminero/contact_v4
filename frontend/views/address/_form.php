<?php

//namespace kartik\depdrop;



use yii\helpers\ArrayHelper;
use frontend\models\Address;
use yii\base\InvalidConfigException;
//use kartik\base\Config;
//use kartik\select2\Select2;

//use kartik\widgets\DepDrop;



use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model frontend\models\Address */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="address-form">


    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'iso')->dropDownList(
                            $model->getCountries(),
                            [
                                'prompt'=>'Select Country',

                                'onchange'=>'
                                    $.post( "index.php?r=address/subdivision&id='.'"+$(this).val(), function( data ) {
                                        $( "select#address-state" ).html( data );
                                    });'

                            ]); ?>

    <?= $form->field($model, 'state')->dropDownList($model->getState( $model->iso ), ['prompt'=>'Select State']); ?>

    <?= $form->field($model, 'street')->textInput(['maxlength' => 30]) ?>

    <?php echo $form->field($model, 'city')->textInput(['maxlength' => 30]) ?>

    <?php
        /*
        echo
        $form->field($model, 'city')->widget(Select2::classname(), [
 //       'data' => ['New York' => 'New York', 'California' => 'California'],
        'data' => $model->getCity(),
        'language' => 'en',
        'options' => ['placeholder' => 'Select a city ...'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
        */
        ?>

    <?= $form->field($model, 'postal_code')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
