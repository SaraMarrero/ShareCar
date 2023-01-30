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
        $dni = $_GET['dni'];
        $selectSQL = $conexion->prepare('SELECT * FROM usuario where dniUsuario=:dni');
        $selectSQL->bindParam("dni", $dni, PDO::PARAM_STR);
        $selectSQL->execute();
        $dniPersonal = $selectSQL->fetch();

        // Se eliminar el usuario seleccionado
        $consultaSQL = $conexion->prepare('DELETE FROM usuario where dniUsuario=:dni');
        $consultaSQL->bindParam("dni", $dniPersonal['dniUsuario'], PDO::PARAM_STR);
        $consultaSQL->execute();    
        
        // Se redirecciona al index.php
        header('Location: perfil.php');

    } catch(PDOException $error){
        $resultado['error'] = true;
    }
?>