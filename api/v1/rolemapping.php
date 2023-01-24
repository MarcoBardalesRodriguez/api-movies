<?php
include_once "Model/classRoleMapping.php";

header("Content-Type:application/json");

$role_mapping = new RoleMapping();

if(isset($_GET["movie_id"]))
{
    $movie_id = $_GET["movie_id"];
    echo json_encode($role_mapping->selectWithMovieId($movie_id));
}

if(isset($_GET["person_id"]))
{
    $person_id = $_GET["person_id"];
    echo json_encode($role_mapping->selectWithPersonId($person_id));
}

?>
