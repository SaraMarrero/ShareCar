<?php
    session_start();
    
    if(isset($_POST["publicarViaje"])){
        $result = [
            "error" => false,
            "mensaje" => "Viaje publicado con éxito"
        ];

        $config = include "config.php";

        try{
            // Se conecta con la base de datos
            $dsn = "mysql:host=" . $config["db"]["host"] . ";dbname=" . $config["db"]["name"];
            $conexion = new PDO($dsn, $config["db"]["user"], $config["db"]["pass"], $config["db"]["options"]);

            // Se coge el id del viaje que se acaba de seleccionar
            $id = $_GET['idViaje'];
            $selectID = $conexion->prepare('SELECT * FROM viaje where idViaje=:id');
            $selectID-> bindParam("id", $id, PDO::PARAM_STR);
            $selectID-> execute();
            $idViaje = $selectID->fetch();

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

<?php include "parts/header.php"; ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mt-4">Reservar viaje</h2>
                <hr>

                <form action="guardarReserva.php" method="post">
                    <div class="form-group">
                        <input type="hidden" name="idViaje" value="<?php echo $_GET['idViaje']; ?>">
                        <label for="plazas">¿Cuántas plazas quedan si usted reserva?</label>
                        <input type="number" name="plazas" id="plazas" class="form-control">
                    </div>

                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-secondary bg-dark" value="Reservar">
                        <a href="verViajes.php" class="btn btn-secondary">Volver a los viajes</a>
                        <a href="index.php" class="btn btn-secondary">Ir al inicio</a>
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
    
<?php include "parts/footer.php"; ?>