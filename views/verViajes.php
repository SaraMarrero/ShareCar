<?php 
    session_start();
    
    $error = false;
    $config = include 'config.php';
    try{
        // Se conecta con la base de datos
        $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
        $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

        // Se seleccionan toda la información de todos los viajes
        $consultaSQL = "SELECT * FROM viaje";
        $sentencia = $conexion->prepare($consultaSQL);
        $sentencia->execute();

        $viaje = $sentencia->fetchAll();

        // Se cogen los datos del usuario que inicio la sesión
        if(isset($_SESSION['email'])){
            $email = $_SESSION['email'];

            $consultaSQL = $conexion->prepare("SELECT * FROM usuario where emailUsuario=:email");
            $consultaSQL->bindParam("email", $email, PDO::PARAM_STR);
            $consultaSQL->execute();
            $usuario = $consultaSQL->fetch();

            // Se comprueba si el usuario que esta iniciado es administrador
            $_SESSION['administrador'] = $usuario['administrador'];
            $admin = $_SESSION['administrador'];
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
            if(isset($_SESSION['email'])){
                // Se muestra lo que vería cada usuario de título (el admin o el usuario normal)
                if($admin == 1){
                    echo "<h2 class='mt-3'>Información sobre los viajes</h2>";
                } else{
                    echo "<h2 class='mt-3'>Viajes disponibles</h2>";
                }
            ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Fecha Salida</th>
                        <th>Origen</th>
                        <th>Destino</th>
                        <th style='text-align: center'>Plazas</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    // Se muestra lo que ven los usuarios normales
                    if($admin == 0){
                        if($viaje && $sentencia->rowCount()>0){
                            foreach($viaje as $fila){
                                if($fila['pasajeros'] != 0){
                ?>
                    <tr>
                        <td><?php echo $fila["fechaSalida"]; ?></td>
                        <td><?php echo $fila["origen"]; ?></td>
                        <td><?php echo $fila["destino"]; ?></td>
                        <td><?php echo $fila["pasajeros"]; ?></td>
                        <td><a href="<?php echo 'reservarViaje.php?idViaje='.$fila['idViaje'] ?>" class="btn btn-secondary mt-4">Reservar plaza</a></td>
                    </tr>
                    <?php
                                }
                            } 
                        }   
                        // Muestra lo que ve el administrador
                    } elseif($admin == 1){
                        if($viaje && $sentencia->rowCount()>0){
                            foreach($viaje as $fila){
                    ?>
                    <tr>
                        <td><?php echo $fila["fechaSalida"]; ?></td>
                        <td><?php echo $fila["origen"]; ?></td>
                        <td><?php echo $fila["destino"]; ?></td>
                        <td style='text-align: center'><?php 
                                if($fila['pasajeros'] == 0){
                                    echo "<p style='color:red'>Sin plazas disponibles</p>";
                                } else{
                                    echo $fila['pasajeros'];
                                }
                            ?></td>
                        <td><a href="<?php echo 'deleteViajes.php?idViaje=' . $fila['idViaje'] ?>" class="btn btn-secondary mt-4">Borrar</a></td>
                    </tr>
                    <?php
                            }
                        }
                    } 
                } else{
                    echo "<h2 style='color: red'>Información no disponible</h2>";
                    echo "<p>Si no esta registrado puede registrarse en el siguiente enlace: <a href='register.php'>Página de registro</a></p>";
                    echo "<p>Si ya está registrado solo tiene que iniciar sesión en el siguiente enlace: <a href='login.php'>Página de login</a></p>";
                }
                    ?>
                </tbody>
            </table>
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