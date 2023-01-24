<?php
include_once "database.php";

define("COLUMNS","id,name,height,date_of_birth,known_for_movies");

class Person extends DataBase
{
    public function selectAll()
    {
        $query = "SELECT COUNT(*) FROM person";
        return $this->executeStatement($query);
    }

    public function selectWhereId($id)
    {
        $query = "SELECT ".COLUMNS." FROM person WHERE id=?";
        $params= array($id);
        return $this->executeStatement($query, $params);
    }

    public function selectWithLimit($init,$long)
    {
        $query = "SELECT ".COLUMNS." FROM person LIMIT ?,?";
        $params = array($init, $long);
        return $this->executeStatement($query, $params);
    }
}


?>
