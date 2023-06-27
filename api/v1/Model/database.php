<?php

class DataBase
{
    const FILE_LOCAL = 'Model/config-local.php';
    const REMOTE_HOST = 'apimovies.apps.marcobardalesrodriguez.site';


    private static function import_file() {
        if ($_SERVER['HTTP_HOST'] === 'localhost' || $_SERVER['HTTP_HOST'] === '127.0.0.1') {
            if (file_exists(self::FILE_LOCAL)) {
                require self::FILE_LOCAL;
            } else {
                trigger_error("Error: El archivo local no existe en la ruta especificada.", E_USER_ERROR);
            }
        } elseif ($_SERVER['HTTP_HOST'] === self::REMOTE_HOST) {
            try {
                define('DB_HOST',$_ENV['DB_HOST']);
                define('DB_PORT',$_ENV['DB_PORT']);
                define('DB_NAME',$_ENV['DB_NAME']);
                define('DB_USERNAME',$_ENV['DB_USERNAME']);
                define('DB_PASSWORD',$_ENV['DB_PASSWORD']);
            } catch (Exception $e) {
                trigger_error("Error: La variable de entorno especificada no existe.", E_USER_ERROR);
            }
        }
    }


    private function connect_PDO()
    {
        self::import_file();
        try{
            if (!defined('DB_HOST') || 
                !defined('DB_PORT') || 
                !defined('DB_NAME') || 
                !defined('DB_USERNAME') || 
                !defined('DB_PASSWORD')) 
            {
                throw new Exception("Error: No se han proporcionado los detalles de conexión a la base de datos.");
            }
            $conn = new PDO("mysql:host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME,DB_USERNAME,DB_PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
        }catch(PDOException $e){
            if ($e->getCode() == 1049) {
                die("Error: La base de datos especificada no existe.");
            } else if ($e->getCode() == 1045) {
                die("Error: Nombre de usuario o contraseña de base de datos incorrectos.");
            } else {
                die('Error: '.$e->getMessage());
            }
        }
        return $conn;
    }


    function executeStatement($query = "", $args = array())
    {
        if (!is_string($query) || empty($query)) {
            throw new InvalidArgumentException("Error: La consulta debe ser una cadena no vacía.");
        }

        if (!is_array($args)) {
            throw new InvalidArgumentException("Error: Los parámetros deben ser un arreglo.");
        }

        try {
            $statement = $this->connect_PDO()->prepare($query);
            if($statement === FALSE)
            {
              echo "Error al preparar la consulta";
            }
            $statement->execute($args);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $error_message = "Error al ejecutar la consulta: " . $e->getMessage();
            error_log($error_message, 0);
            return false;
        }
        return $result;
    }
}
