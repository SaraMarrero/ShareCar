<?php
    $config = include 'config.php';

    // Se conecta con la base de datos
    $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
    $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

    // Se recogen los datos introducidos en el formulario
    $dni = $_POST['dni'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellidos'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Se actualiza la base de datos
    $consulta = $conexion->prepare('UPDATE usuario SET dniUsuario = ?, nombreUsuario = ?, apellidosUsuario = ?, emailUsuario = ?, passwordUsuario = ? WHERE dniUsuario = ?;');
    $sentencia = $consulta->execute([$dni, $nombre, $apellido, $email, $password, $dni]);

    // Se redirecciona a la página de ver los usuarios
    header('Location: perfil.php');
?>