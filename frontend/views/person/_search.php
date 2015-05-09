<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use frontend\models\Address;
use frontend\controllers\AddressController;
/* @var $this yii\web\View */
/* @var $model app\models\Person */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="search-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // echo $form->field($model, 'id')->dropDownList( $model->getNames()  ); ?>

    <?php

    echo
    $form->field($model, 'id')->widget(Select2::classname(), [
//       'data' => ['New York' => 'New York', 'California' => 'California'],
    'data' => $model->getNames(),
    'language' => 'en',
    'options' => ['placeholder' => 'Select a name'],
    'pluginOptions' => [
    'allowClear' => true
    ],
]);

    ?>




    <div class="form-group">
        <?= Html::submitButton('Show Profile', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>