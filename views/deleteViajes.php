<?php
    session_start();

    $resultado = [
        'error' => false,    
    ];

    $config = include 'config.php';

    try{
        // Se conecta con la base de datos
        $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
        $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

        // Se coge el id del usuario que se acaba de seleccionar
        $idViaje = $_GET['idViaje'];
        $selectSQL = $conexion->prepare('SELECT * FROM viaje where idViaje=:id');
        $selectSQL->bindParam("id", $idViaje, PDO::PARAM_STR);
        $selectSQL->execute();
        $dniPersonal = $selectSQL->fetch();

        // Se eliminar el usuario seleccionado
        $consultaSQL = $conexion->prepare('DELETE FROM viaje where idViaje=:id');
        $consultaSQL->bindParam("id", $idViaje, PDO::PARAM_STR);
        $consultaSQL->execute();      
        
        // Se redirecciona al verViajes.php
        header('Location: verViajes.php');

    } catch(PDOException $error){
        $resultado['error'] = true;
    }
?>