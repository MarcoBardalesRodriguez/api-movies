<?php
include_once "Model/classMovie.php";

header("Content-Type:application/json");

$movie = new Movie();


if($_GET == [])
{
    echo json_encode($movie->selectAll());
}

if(isset($_GET["id"]))
{
    $id = $_GET["id"];
    echo json_encode($movie->selectWhereId($id));

}

if(isset($_GET["init_limit"]) && isset($_GET["long_limit"]))
{
    $init = $_GET["init_limit"];
    $long = $_GET["long_limit"];
    echo json_encode($movie->selectWithLimit($init,$long));

}

