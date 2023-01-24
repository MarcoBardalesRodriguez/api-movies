<?php
include_once "database.php";

define("COLUMNS_PERSON","P.id,P.name,P.height,P.date_of_birth,P.known_for_movies,R.role");
define("COLUMNS_MOVIE","M.id,M.title,M.date_published,M.duration,M.country,M.worldwide_gross_income,M.languages,M.production_company");

class RoleMapping extends DataBase
{
    public function selectWithMovieId($id)
    {
        $query = "SELECT ".COLUMNS_PERSON." 
                FROM movie M 
                INNER JOIN role_mapping R ON M.id = R.movie_id 
                INNER JOIN person P ON R.person_id = P.id 
                WHERE R.movie_id = ?";
        $params = array($id);
        return $this->executeStatement($query, $params);
    }

    public function selectWithPersonId($id)
    {
        $query = "SELECT ".COLUMNS_MOVIE." 
                FROM person P 
                INNER JOIN role_mapping R ON P.id = R.person_id 
                INNER JOIN movie M ON R.movie_id = M.id 
                WHERE R.person_id = ?";
        $params = array($id);
        return $this->executeStatement($query, $params);
    }
}
?>
