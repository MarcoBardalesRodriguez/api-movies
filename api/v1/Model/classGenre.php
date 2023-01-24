<?php
include_once "database.php";

define("COLUMNS","id,name");

class Genre extends DataBase
{
    public function selectAll()
    {
        $query = "SELECT COUNT(*) FROM genre";
        return $this->executeStatement($query);
    }

    public function selectWhereId($id)
    {
        $query = "SELECT ".COLUMNS." FROM genre WHERE id=?";
        $params = array($id);
        return $this->executeStatement($query,$params);
    }

    public function selectWithLimit($init,$long)
    {
        $query = "SELECT ".COLUMNS." FROM genre LIMIT ?,?";
        $params = array($init,$long);
        return $this->executeStatement($query,$params);
    }
}

?>
