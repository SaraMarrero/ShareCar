<?php
/**
    * @version 1.0
    * @package views
 */
    session_start();

    include '../functions/functions.php';

    // Se llama a la función que conecta con la base de datos
    $conexion = conexion();

    // Se recogen los datos introducidos en el formulario
    $plazas = $_POST['plazas'];
    $id = $_POST['idViaje'];

    // // Se actualiza la base de datos
    $consulta = $conexion->prepare('UPDATE viaje SET pasajeros = ? where idViaje = ?;');
    $sentencia = $consulta->execute([$plazas, $id]);

    // Se redirecciona a la página de ver los viajes
    header('Location: verViajes.php');
?>