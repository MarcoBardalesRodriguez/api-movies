<?php
include_once "Model/classRating.php";

header("Content-Type:application/json");

$rating = new Rating();

if(isset($_GET["id"]))
{
    $id = $_GET["id"];
    //echo $id;
    echo json_encode($rating->selectWhereId($id));

}
?>
