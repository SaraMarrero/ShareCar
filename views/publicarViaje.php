<?php
    session_start();

    include '../functions/functions.php';

    if(isset($_SESSION['email'])){
    
    if(isset($_POST["publicarViaje"])){
        $result = [
            "error" => false,
            "mensaje" => "Viaje publicado con éxito"
        ];

        $config = include "config.php";

        try{
            // Se conecta con la base de datos
            $conexion = conexion();

            // Se almacenan los daots del formulario 
            $viaje = [
                "fechaSalida" => $_POST['fechaSalida'],
                "origen" => $_POST['origen'],
                "destino" => $_POST['destino'],
                "pasajeros" => $_POST['pasajeros']
            ];

            // Se actualiza la tabla viaje con los nuevos datos
            if(empty($_POST["fechaSalida"]) || empty($_POST['origen']) || empty($_POST['destino']) || empty($_POST['pasajeros'])){
                echo "<p style='color:red;'>Debe rellenar todos los campos</p>";
            }else{
                $consultaSQL = "INSERT INTO viaje (fechaSalida, origen, destino, pasajeros)";
                $consultaSQL .= "values (:" . implode(", :" , array_keys($viaje)) . ")";

                $sentencia = $conexion -> prepare($consultaSQL);
                $sentencia -> execute($viaje);
            }

        } catch(PDOException $error) {
            $resultado["error"] = true;
            $resultado["mensaje"] = $error -> getMessage();
        }
    }
?>

<?php
    if(isset($resultado)) {
    ?>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert- <?= $resultado['error'] ? 'danger' : 'success' ?>" role="alert">
                    <?= $resultado["mensaje"] ?>
                </div>
            </div>
        </div>
    </div>

    <?php
        }
    ?>

<?php include "../parts/header.php"; ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mt-4">Publica un viaje</h2>
                <hr>

                <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
                    <div class="form-group">
                        <label for="fechaSalida">Fecha de salida</label>
                        <input type="date" name="fechaSalida" id="fechaSalida" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="origen">Origen</label>
                        <input type="text" name="origen" id="origen" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="destino">Destino</label>
                        <input type="text" name="destino" id="destino" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="pasajeros">Número de pasajeros (incluyendo conductor)</label>
                        <input type="number" name="pasajeros" id="pasajeros" class="form-control">
                    </div>

                    <div class="form-group">
                        <input type="submit" name="publicarViaje" class="btn btn-secondary" value="Publicar">
                        <a href="../index.php" class="btn btn-secondary">Regresar al inicio</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer class="text-center text-white fixed-bottom">
        <div class="text-center p-3  bg-dark">
            shareCar, 2023©
        </div>
    </footer>

<?php 
    include "../parts/footer.php"; 
    } else{
        include "../parts/header.php";
        echo "<h2 style='color: red; margin-left: 12em;'>Información no disponible</h2>";
        echo "<p style='margin-left: 24em;'>Si no esta registrado puede registrarse en el siguiente enlace: <a href='register.php'>Página de registro</a></p>";
        echo "<p style='margin-left: 24em;'>Si ya está registrado solo tiene que iniciar sesión en el siguiente enlace: <a href='login.php'>Página de login</a></p>";
        echo "<a  style='margin-left: 24em;' href='../index.php' class='btn btn-secondary'>Regresar al inicio</a>";
        include "../parts/footer.php"; 
    }
?>