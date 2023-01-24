<?php
include_once "Model/classPerson.php";

header("Content-Type:application/json");

$person = new Person();

if($_GET == [])
{
    echo json_encode($person->selectAll());
}

if(isset($_GET["id"]))
{
    $id = $_GET["id"];
    echo json_encode($person->selectWhereId($id));
}

if(isset($_GET["init_limit"]) && isset($_GET["long_limit"]))
{
    $init = $_GET["init_limit"];
    $long = $_GET["long_limit"];

    echo json_encode($person->selectWithLimit($init,$long));
}

?>
