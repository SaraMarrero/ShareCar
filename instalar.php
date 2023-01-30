<?php
    $config = include 'config.php';
    try{
        $conexion = new PDO('mysql:host=' . $config['db']['host'],$config['db']['user'],$config['db']['pass'],$config['db']['options']);
        $sql = file_get_contents("data/bbdd.sql");
        $conexion->exec($sql);
        echo "La base de datos y las tablas usuario, viaje y datos viaje ha sido creaa con éxito";
    } catch(PDOException $error){
        echo $error->getMessage();
    }
?>