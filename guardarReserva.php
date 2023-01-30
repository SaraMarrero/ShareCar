<?php
    session_start();

    $config = include 'config.php';

    // Se conecta con la base de datos
    $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
    $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

    // Se recogen los datos introducidos en el formulario
    $plazas = $_POST['plazas'];
    $id = $_POST['idViaje'];

    // // Se actualiza la base de datos
    $consulta = $conexion->prepare('UPDATE viaje SET pasajeros = ? where idViaje = ?;');
    $sentencia = $consulta->execute([$plazas, $id]);

    // Se rellena la tabla de los datos del viaje
    // $idViaje = $id;
    // $dniUsuario = $_SESSION['dni']; 

    // $consultaViaje = $conexion->prepare('UPDATE datosViaje SET idViaje = ?, dniUsuario = ?;');
    // $sentenciaViaje = $consultaViaje->execute([$idViaje, $dniUsuario]);

    // Se redirecciona a la página de ver los viajes
    header('Location: verViajes.php');
?>