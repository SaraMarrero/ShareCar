<?php
    session_start();

    include '../functions/functions.php';
    $config = include 'config.php';

    // Se conecta con la base de datos
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