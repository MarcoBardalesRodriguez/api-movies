<?php
include_once "Model/classGenreMapping.php";

header("Content-Type:application/json");

$genre_mapping = new GenreMapping();

if(isset($_GET["movie_id"]))
{
    $movie_id = $_GET["movie_id"];
    echo json_encode($genre_mapping->selectWithMovieId($movie_id));
}

if(isset($_GET["genre_id"]))
{
    $person_id = $_GET["genre_id"];
    $init_limit = $_GET["init_limit"];
    $long_limit = $_GET["long_limit"];
    echo json_encode($genre_mapping->selectWithGenreId($person_id,$init_limit,$long_limit));
}

?>
