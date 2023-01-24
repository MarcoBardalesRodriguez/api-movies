<?php
//require_once "config.php";
require_once "remote-config.php";

class DataBase
{
    private function connect_PDO()
    {
        try{
            //Connection with environment variables
            //$dsn = "mysql:host={$_ENV["HOST"]};port={$_ENV["PORT"]};dbname={$_ENV["DATABASE"]}";
            //$conn = new PDO($dsn, $_ENV["USERNAME"], $_ENV["PASSWORD"]);

            //Connection with file remote-config.php
            $conn = new PDO("mysql:host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME,DB_USERNAME,DB_PASSWORD);

            //Connection with file config.php
            //$conn = new PDO("mysql:host=".DB_HOST_LOCAL.";dbname=".DB_NAME_LOCAL,DB_USERNAME_LOCAL,DB_PASSWORD_LOCAL);

            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
        }catch(Exception $e){
            die('Error: '.$e->getMessage());
        }
        return $conn;
    }

    //funcion que recive una consulta sql con/sin parametros, y los parametros necesarios
    //prepara la consulta 
    //y retorna un objeto iterable
    function executeStatement($query = "", $args = array())
    {
        $statement = $this->connect_PDO()->prepare($query);
        if($statement === FALSE)
        {
          echo "Error: Can't prepare query";
        }

        try{
          $statement->execute($args);
        }catch(Exception $e){
          die($e->getMessage());
        }

        $result = $statement->fetchAll();
        return $result;
    }
}
