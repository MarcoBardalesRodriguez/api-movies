<?php
require_once "database.php";

define("COLUMNS", "id,title,year,date_published,duration,country,worldwide_gross_income,languages,production_company");

class Movie extends DataBase
{

    public function selectAll()
    {
        $query = "SELECT COUNT(*) FROM movie";
        return $this->executeStatement($query);
    }

    public function selectWhereId($id)
    {
        $query = "SELECT ".COLUMNS." FROM movie WHERE id=?";
        $params = array($id);
        return $this->executeStatement($query,$params);
    }

    public function selectWithLimit($init, $long)
    {
        $query = "SELECT ".COLUMNS." FROM movie LIMIT ?,?";
        $params = array($init, $long);
        return $this->executeStatement($query,$params);
    }
}
