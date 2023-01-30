<?php
    session_start();
    
    if(isset($_POST["registrarse"])){
        $result = [
            "error" => false,
            "mensaje" => "El usuario " . $_POST["nombre"] . " ha sido registrado con éxito"    
        ];

        $config = include "config.php";

        try{
            // Se conecta con la base de datos
            $dsn = "mysql:host=" . $config["db"]["host"] . ";dbname=" . $config["db"]["name"];
            $conexion = new PDO($dsn, $config["db"]["user"], $config["db"]["pass"], $config["db"]["options"]);

            // Se almacenan los datos de formulario
            $usuario = [
                "dniUsuario" => $_POST["dni"],
                "nombreUsuario" => $_POST['nombre'],
                "apellidosUsuario" => $_POST["apellidos"],
                "emailUsuario" => $_POST["email"],
                "passwordUsuario" => $_POST["password"]
                // password_hash($_POST["password"],PASSWORD_DEFAULT)
            ];

            // Se selecciona todos los datos del usuario introducido en el formulario
            $selectDatos = $conexion->prepare("SELECT * FROM usuario WHERE dniUsuario=:dni");
            $selectDatos->bindParam("dni", $usuario["dniUsuario"], PDO::PARAM_STR);
            $selectDatos->execute();

            // Se comprueba si el existe
            if($selectDatos->rowCount() > 0){
                echo "<p style='color: red'>El usuario ya existe</p>";
            }

            // Si no existe el usuario se insertan los datos en la tabla usuario
            if(empty($_POST["dni"]) || empty($_POST['nombre']) || empty($_POST['apellidos']) || empty($_POST['email']) || empty($_POST['password'])){
                echo "<p style='color:red;'>Debe rellenar todos los campos</p>";
            
            } elseif($selectDatos->rowCount() == 0){
                $consultaSQL = "INSERT INTO usuario (dniUSuario, nombreUsuario, apellidosUsuario, emailUsuario, passwordUsuario)";
                $consultaSQL .= "values (:" . implode(", :" , array_keys($usuario)) . ")";
                $sentencia = $conexion -> prepare($consultaSQL);
                $sentencia -> execute($usuario);

                

                if($sentencia){
                    echo "<p style='color: green'>El usuario " . $_POST["nombre"] . " ha sido registrado con éxito</p>";
                } else{
                    echo "<p>Error</p>";
                }
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="./css/login.css">
    <title>Register</title>
</head>
<body>

<section class="vh-100" style="background-color: #272731; margin-top: 3em;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
            <div class="card" style="border-radius: 1rem;">
            <div class="row g-0">
                <div class="col-md-6 col-lg-5 d-none d-md-block">
                <img src="./img/personas.PNG" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem; margin-top: 13em;" />
                </div>
                <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">

                    <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">

                    <div class="d-flex align-items-center mb-3 pb-1">
                        <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                        <span class="h1 fw-bold mb-0">Share Car</span>
                    </div>

                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Página de acceso</h5>

                    <div class="form-outline mb-4">
                        <label>DNI</label>
                        <input type="text" class="form-control" name="dni" placeholder="Dni">
                    </div>

                    <div class="form-outline mb-4">
                        <label>Nombre</label>
                        <input type="text" class="form-control" name="nombre" placeholder="Nombre">
                    </div>

                    <div class="form-outline mb-4">
                        <label>Apellidos</label>
                        <input type="text" class="form-control" name="apellidos" placeholder="Apellidos">
                    </div>
                    
                    <div class="form-outline mb-4">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Email">
                    </div>

                    <div class="form-outline mb-4">
                        <label>Contraseña</label>
                        <input type="password" class="form-control" name="password" placeholder="Contraseña">
                    </div>

                    <div class="pt-1 mb-4">
                        <button type="submit" class="btn btn-secondary bg-dark" name="registrarse">Registrarse</button>
                        <a type="button" class="btn btn-secondary bg-dark" href="./login.php">Ir al Login</a>
                        <a type="button" class="btn btn-secondary" href="./index.php">Página principal</a>
                    </div>
                    <a href="#!" class="small text-muted">Terms of use.</a>
                    <a href="#!" class="small text-muted">Privacy policy</a>
                    </form>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</section>
</body>
</html>