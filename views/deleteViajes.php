<?php
/**
    * @version 1.0
    * @package views
 */

    session_start();

    include '../functions/functions.php';

    $resultado = [
        'error' => false,    
    ];

    try{
        // Se llama a la función que conecta con la base de datos
        $conexion = conexion();

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