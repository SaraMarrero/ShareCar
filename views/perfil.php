<?php 
    session_start();

    include '../functions/functions.php';

    $error = false;
    $config = include 'config.php';

    try{
        // Se llama a la función que conecta con la base de datos
        $conexion = conexion();

        if(isset($_SESSION['email'])){ 

            // Se comprueba el email del usuario y se recogen todos sus datos
            $email = $_SESSION['email'];

            $consultaSQL = $conexion->prepare("SELECT * FROM usuario where emailUsuario=:email");
            $consultaSQL->bindParam("email", $email, PDO::PARAM_STR);
            $consultaSQL->execute();
            $usuario = $consultaSQL->fetchAll();

            $_SESSION['dni'] = $usuario[0]['dniUsuario'];

            // Se comprueba si es adminsitrador o usuario normal
            $_SESSION['administrador'] = $usuario[0]['administrador'];
            $admin = $_SESSION['administrador'];
            
            $sentenciaSQL = $conexion->prepare("SELECT * FROM usuario");
            $sentenciaSQL->execute();
            $administrador = $sentenciaSQL->fetchAll();
            
        } 

    } catch(PDOException $error){
        $error = $error->getMessage();
    }
?>

<?php include '../parts/header.php' ?>

<?php
    if($error){
    ?>
    <div class="container mt-2">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-dange" role="alert">
                    <?= $error ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php    
                // Se comprueba si hay sesión iniciada
                if(!isset($_SESSION['email'])){
                    echo "<h2 style='color: red'>Información no disponible</h2>";
                    echo "<p>Si no esta registrado puede registrarse en el siguiente enlace: <a href='register.php'>Página de registro</a></p>";
                    echo "<p>Si ya está registrado solo tiene que iniciar sesión en el siguiente enlace: <a href='login.php'>Página de login</a></p>";
                } elseif($admin == 1){
                    // Muesta lo que vería el administrador
                    if($administrador && $consultaSQL->rowCount()>0){
            ?>
            <h1 class="mt-3">Datos de usuario</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>DNI</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Email</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($administrador as $fila){
                            if($fila["dniUsuario"] != "12345678R"){
                    ?>
                    <tr>
                        <td style='text-align: center;'><?php echo $fila["dniUsuario"]; ?></td>
                        <td><?php echo $fila["nombreUsuario"]; ?></td>
                        <td><?php echo $fila["apellidosUsuario"]; ?></td>
                        <td><?php echo $fila["emailUsuario"]; ?></td>
                        <td><a href="<?php echo 'deleteUser.php?dni=' . $fila['dniUsuario'] ?>" class="btn btn-secondary mt-4">Borrar</a></td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
            <?php   
                } else{
                    echo "<h2 style='color: red'>No hay usuarios registrados</h2>";
                }

            } elseif($admin == 0){
                // Muesta lo que vería el usuario
            ?>
            <h1 class="mt-3">Datos de usuario</h1>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                    <th>Contraseña</th>
                    <th></th>
                </tr>
                </thead>
            <tbody>
                <?php
                    foreach($usuario as $fila){
                ?>
                <tr>
                    <td><?php echo $fila["dniUsuario"]; ?></td>
                    <td><?php echo $fila["nombreUsuario"]; ?></td>
                    <td><?php echo $fila["apellidosUsuario"]; ?></td>
                    <td><?php echo $fila["emailUsuario"]; ?></td>
                    <td><?php echo $fila["passwordUsuario"]; ?></td>
                    <td><a href="<?php echo 'editUser.php?dni=' . $fila['dniUsuario'] ?>" class="btn btn-secondary mt-4">Editar</a></td>
                </tr>
                </tbody>
            </table>
            <?php
                }

            }
            ?> 
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="../index.php" class="btn btn-secondary mt-4">Regresar al incio</a>
        </div>
    </div>
</div>

<?php include '../parts/footer.php' ?>