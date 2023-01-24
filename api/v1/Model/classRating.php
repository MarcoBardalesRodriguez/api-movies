<?php
include_once "database.php";

define("COLUMNS","movie_id,rating,total_votes,median_rating");

class Rating extends DataBase
{

    public function selectWhereId($id)
    {
        $query = "SELECT ".COLUMNS." FROM rating WHERE movie_id=?";
        $params = array($id);
        return $this->executeStatement($query,$params);
    }
}

?>
