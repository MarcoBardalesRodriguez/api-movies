<?php
include_once "Model/classGenre.php";

header("Content-Type:application/json");

$genre = new Genre();

if($_GET == [])
{
    echo json_encode($genre->selectAll());
}

if(isset($_GET["id"]))
{
    $id = $_GET["id"];
    echo json_encode($genre->selectWhereId($id));

}

if(isset($_GET["init_limit"]) && isset($_GET["long_limit"]))
{
    $init = $_GET["init_limit"];
    $long = $_GET["long_limit"];
    echo json_encode($genre->selectWithLimit($init,$long));
}

?>
