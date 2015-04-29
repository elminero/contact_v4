<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
/**
 * Created by PhpStorm.
 * User: Ian
 * Date: 4/28/2015
 * Time: 4:58 PM
 */

/* @var $this yii\web\View */
/* @var $model app\models\Person */
$this->title = 'Profile';


$div2Color = "black";

$nameDOB = "Name: " . $model->last_name . " " . $model->first_name . " " . $model->middle_name . "<br />" .
    "Alias: " . $model->alias_name . "<br />";

if(($model->birth_year != 0) AND ($model->birth_month != 0) AND ($model->birth_day !=0))
{
    $nameDOB .= "DOB: " . $model->getMonthNameByNumber($model->birth_month)  . " " . $model->birth_day . ", " . $model->birth_year . "<br />";
}




if(($model->birth_year == 0) || ($model->birth_month == 0) || ($model->birth_day == 0))
{
    if(($model->birth_year == 0) && ($model->birth_month == 0) && ($model->birth_day == 0))
    {
        $nameDOB .= "DOB: Unknown";
    }

    if(($model->birth_year != 0) || ($model->birth_month != 0) || ($model->birth_day != 0))
    {
        $nameDOB .= "DOB Incomplete : ";
    }

    if($model->birth_year != 0)
    {
        $nameDOB .= " Year: " . $model->birth_year;
        if($model->birth_month != 0)
        {
            $nameDOB .= ", ";
        }
        if($model->birth_day != 0)
        {
            $nameDOB .= ", ";
        }
    }

    if($model->birth_month != 0)
    {
        $nameDOB .= " Month: " . $model->getMonthNameByNumber($model->birth_month); if($model->birth_day != 0)
    {
        $nameDOB .= ", ";
    }
    }

    if($model->birth_day != 0)
    {
        $nameDOB .= " Day: " . $model->birth_day;
    }

    $nameDOB .= "<br />Age Unknown<br />";
}

if(($model->birth_year != 0) AND ($model->birth_month != 0) AND ($model->birth_day !=0))
{
    $nameDOB .= "Age: " . $model->getAge($model->birth_year, $model->birth_month, $model->birth_day). "<br />";
}

$nameDOB .= "Note: " . $model->note;





?>

<div style="float: left"><!--Start BreadCrumbs div 1-->
    <?php
    $this->title = "Profile " . $model->id;

    $this->params['breadcrumbs'][] = ['label' => 'List', 'url' => ['list']];
    $this->params['breadcrumbs'][] = ['label' => $this->title ];
    ?>
</div><!--End BreadCrumbs div 1-->


<div class="row">

    <div class="col-lg-2">
        <p>

            <?php if($model->avatar): ?>
                <?php
                echo Html::a('<img src=" ' . Yii::$app->getUrlManager()->getBaseUrl() . '/pictures/' . $model->avatar['file_name'] . '_t.jpg" />',
                    ['person/portfolio', 'id' => $model->id], ['class' => '']);
                ?>
            <?php endif ?>

        </p>


        <p>
            &nbsp &nbsp
            <?php
            echo Html::a('Photos', ['person/portfolio', 'id' => $model->id], ['class' => '']);
            ?>
            &nbsp &nbsp
            <?php
            echo Html::a('Add', ['picture/create', 'id' => $model->id], ['class' => '']);
            ?>
            &nbsp &nbsp
            <?php
            echo Html::a('Edit', ['person/select', 'id' => $model->id], ['class' => '']);
            ?>


        </p>

    </div>




    <div class="col-lg-2">

        <h4>Name and DOB</h4>

        <p>
            <?php
            // echo $nameDOB;
            echo Html::a($nameDOB, ['update', 'id' => $model->id], ['class' => '']);
            ?>
        </p>

    </div>


    <div class="col-lg-2">
        <h4>
            <?php
            echo Html::a('Add a Phone Number', ['phone-number/create', 'id' => $model->id], ['class' => '']);
            ?>
        </h4>


        <?php
        foreach($model->phoneNumbers as $phoneNumber) {
            $phoneData = $phoneNumber->type . "<br /> " . $phoneNumber->phone . "<br /> " . $phoneNumber->note . "<hr />";
            echo Html::a($phoneData, ['phone-number/update', 'id' => $phoneNumber->id], ['class' => '']);
        }
        ?>


    </div>


    <div class="col-lg-2">
        <h4>
            <?php
            echo Html::a('Add an eMail Address', ['email-address/create', 'id' => $model->id], ['class' => '']);
            ?>
        </h4>

        <p>
            <?php
            foreach($model->emailAddresses as $emailAddress) {
                $emailAddressData = $emailAddress->type . "<br />" . $emailAddress->email . "<br />" . $emailAddress->note . "<hr />";
                echo Html::a($emailAddressData, ['email-address/update', 'id' => $emailAddress->id], ['class' => '']);
            }
            ?>
        </p>
    </div>


    <div style="clear: both"></div>

    <div>
        <hr />
        <h4>
            <?php
            echo Html::a('Add an Address', ['address/create', 'id' => $model->id], ['class' => '']);
            ?>
        </h4>




        <?php
        foreach($model->addresses as $address): ?>
            <div class="col-lg-2">
                <?php


                $addressInfo = $address->type . "<br />" .
                    $address->street . "<br />" .
                    $address->city . ", " . $address->state . " ". $address->postal_code . " " . $address->iso . "<br />" .
                    $address->note . "<br /><br />";

                echo Html::a($addressInfo, ['address/update', 'id' => $address->id], ['class' => '']);

                ?>

            </div>



        <?php endforeach ?>


    </div>





</div>