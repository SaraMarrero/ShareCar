<?php
    $config = include 'config.php';

    include '../functions/functions.php';

    // Se llama a la función que conecta con la base de datos
    $conexion = conexion();
    
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