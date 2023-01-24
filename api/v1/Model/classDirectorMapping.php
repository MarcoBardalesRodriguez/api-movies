<?php
include_once "database.php";

define("COLUMNS_PERSON","P.id,P.name,P.height,P.date_of_birth,P.known_for_movies");
define("COLUMNS_MOVIE","M.id,M.title,M.date_published,M.duration,M.country,M.worldwide_gross_income,M.languages,M.production_company");

class DirectorMapping extends DataBase
{
    public function selectWithMovieId($id)
    {
        $query = "SELECT ".COLUMNS_PERSON." 
                FROM movie M 
                INNER JOIN director_mapping D ON M.id = D.movie_id 
                INNER JOIN person P ON D.person_id = P.id 
                WHERE D.movie_id = ?";
        $params = array($id);
        return $this->executeStatement($query, $params);
    }

    public function selectWithPersonId($id)
    {
        $query = "SELECT ".COLUMNS_MOVIE." 
                FROM person P 
                INNER JOIN director_mapping D ON P.id = D.person_id 
                INNER JOIN movie M ON D.movie_id = M.id 
                WHERE D.person_id = ?";
        $params = array($id);
        return $this->executeStatement($query, $params);
    }
}



?>
