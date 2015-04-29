<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
/**
 * Created by PhpStorm.
 * User: Ian
 * Date: 4/29/2015
 * Time: 1:30 AM
 */
/* @var $this yii\web\View */
/* @var $model app\models\Person */
$this->title = 'Select Picture for Edit';

$this->params['breadcrumbs'][] = ['label' => 'List', 'url' => ['person/list']];

$this->params['breadcrumbs'][] = ['label' =>  "Profile " . $model->id, 'url' => ['person/profile', 'id' => $model->id], ];

$this->params['breadcrumbs'][] = ['label' =>  $this->title,];
?>


<?php
foreach( $model->pictures as $picture ): ?>

    <div style="margin: 10px;">

        <div style="float: left">
            <?php
            echo Html::a('<img src=" ' . Yii::$app->getUrlManager()->getBaseUrl() . '/pictures/' . $picture->file_name . '_t.jpg" /> ',
                ['picture/display', 'id' => $picture->id], ['class' => '']);
            ?>
        </div>

        <div style="float: left; margin-left: 10px;">
            <span style="color: red"><?php if($picture->avatar){echo "Avatar";} ?><br/></span>
            Caption: <?php echo $picture->caption; ?><br />
            Copyright: <?php echo $picture->copyright; ?><br />
            Date Uploaded: <?php echo $picture->date_entered; ?><br />
            Date Updated: <?php echo $picture->date_updated; ?><br />
        </div>

        <div style="clear: both"></div>

        <div style="float: left; margin-left: 10px; width: 155px">

            <div style="float: left">
                <?php
                echo Html::a('Edit',['picture/update', 'id' => $picture->id, ],  ['class' => '']);
                ?>
            </div>

            <div style="float: right">

                <?php
                echo Html::a('delete',['person/select', 'id' => $picture->person_id, 'remove' => $picture->id],  ['class' => '']);
                ?>

            </div>

        </div>

        <div style="clear: both"></div>

        <hr />

    </div>

<?php
endforeach ?>