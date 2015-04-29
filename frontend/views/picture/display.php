<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * Created by PhpStorm.
 * User: Ian
 * Date: 4/29/2015
 * Time: 12:58 AM
 */

/* @var $this yii\web\View */
/* @var $model app\models\Person */

?>

    <div style="float: left"><!--Start BreadCrumbs div 1-->
        <?php
        $this->title = 'Picture';

        //     Home People Profile Portfolio Picture


        $this->params['breadcrumbs'][] = ['label' => 'List', 'url' => ['person/list']];

        $this->params['breadcrumbs'][] = ['label' => "Profile " . $model->person_id, 'url' => ['person/profile', 'id' => $model->person_id], ];

        $this->params['breadcrumbs'][] = ['label' => "Portfolio " . $model->person_id, 'url' => ['person/portfolio', 'id' => $model->person_id], ];

        $this->params['breadcrumbs'][] = ['label' => $this->title];

        ?>
    </div><!--End BreadCrumbs div 1-->
    <div align="center" style="margin:1px; padding:1px;">
        <div style="width: 250px;">
            <?php
            echo Html::a('<--PREVIOUS',
                ['picture/display', 'id' => $previous], ['class' => '']);
            ?>
            &nbsp;&nbsp;&nbsp;

            <?php
            echo Html::a('NEXT-->',
                ['picture/display', 'id' => $next], ['class' => '']);
            ?>
        </div>

        <?php
        $img = "<img src=" . Yii::$app->getUrlManager()->getBaseUrl() . "/pictures/" . $model->file_name . ".jpg />";
        echo Html::a($img,
            ['picture/display', 'id' => $previous], ['class' => '']);

        ?>
    </div>

<?php