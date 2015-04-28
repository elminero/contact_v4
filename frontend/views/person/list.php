<?php
use yii\helpers\Html;

/**
 * Created by PhpStorm.
 * User: Ian
 * Date: 4/28/2015
 * Time: 4:37 PM
 */

$this->params['breadcrumbs'][] = ['label' => 'List'];

foreach($namesWithAddress as $name) {

    $nameAddress =

        $name["last_name"];

    if($name["last_name"] && $name["first_name"]) $nameAddress .= ", " . $name["first_name"];

    if( ($name["last_name"] || $name["first_name"]) && $name["middle_name"]) $nameAddress .= ", " . $name["middle_name"];

    if($name["alias_name"])  $nameAddress .= "<br />Alias: " . $name["alias_name"];


    $nameAddress .= "<br />";

    $nameAddress .= $name["street"];

    if($name["street"] && $name["city"]) $nameAddress .= ", " . $name["city"];

    if( ($name["street"] || $name["city"]) && $name["state"]) $nameAddress .= ", " . $name["state"]. " " . $name["postal_code"] . " " .$name["iso"];


    //  echo $nameAddress; ['post/index', 'page' => 2]


    echo Html::a($nameAddress, ['person/profile', 'id'=>$name["id"]], ['class' => '']);


    echo "<hr />";
    
}

