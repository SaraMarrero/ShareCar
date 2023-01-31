<?php
/**
    * @version 1.0
    * @package functions
 */

    function conexion(){
        // Se llama la ruta donde está el archivo de configuración con la base de datos
        $config = include '../views/config.php';
        $dsn = "mysql:host=" . $config["db"]["host"] . ";dbname=" . $config["db"]["name"];
        $conexion = new PDO($dsn, $config["db"]["user"], $config["db"]["pass"], $config["db"]["options"]);
        return $conexion;
    }
?>