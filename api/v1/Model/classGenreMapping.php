<?php
include_once "database.php";

define("COLUMNS_GENERE","G.id,G.name");
define("COLUMNS_MOVIE","M.id,M.title,M.date_published,M.duration,M.country,M.worldwide_gross_income,M.languages,M.production_company");

class GenreMapping extends DataBase
{
    public function selectWithMovieId($id)
    {
        $query = "SELECT ".COLUMNS_GENERE." 
                FROM movie M 
                INNER JOIN genre_mapping R ON M.id = R.movie_id 
                INNER JOIN genre G ON R.genre_id = G.id 
                WHERE R.movie_id = ?";
        $params = array($id);
        return $this->executeStatement($query, $params);
    }

    public function selectWithGenreId($id,$init,$long)
    {
        $query = "SELECT ".COLUMNS_MOVIE." 
                FROM genre G 
                INNER JOIN genre_mapping R ON G.id = R.genre_id 
                INNER JOIN movie M ON R.movie_id = M.id 
                WHERE R.genre_id = ? Limit ?,?";
        $params = array($id,$init,$long);
        return $this->executeStatement($query, $params);
    }
}
?>
