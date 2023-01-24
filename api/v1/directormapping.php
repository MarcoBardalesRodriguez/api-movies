<?php
include_once "Model/classDirectorMapping.php";

header("Content-Type:application/json");

$director_mapping = new DirectorMapping();

if(isset($_GET["movie_id"]))
{
    $movie_id = $_GET["movie_id"];
    echo json_encode($director_mapping->selectWithMovieId($movie_id));
}

if(isset($_GET["person_id"]))
{
    $person_id = $_GET["person_id"];
    echo json_encode($director_mapping->selectWithPersonId($person_id));
}

?>
