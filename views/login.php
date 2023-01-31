<?php
    session_start();

    include '../functions/functions.php';
    
    if(isset($_POST["login"])){
        $result = [
            "error" => false,
            "mensaje" => "El usuario " . $_POST["email"] . "no existe"
        ];

        $config = include "config.php";

        try{
            // Se llama a la función que conecta con la base de datos
            $conexion = conexion();

            // Se cogen los datos del formulario y se seleccionan los datos de ese usuario
            $email = $_POST['email'];
            $password = $_POST['password'];

            $selectDatos = $conexion->prepare("SELECT * FROM usuario where emailUsuario=:email");
            $selectDatos->bindParam("email", $email, PDO::PARAM_STR);
            $selectDatos->execute();

            $final = $selectDatos->fetch(PDO::FETCH_ASSOC);
                // password_hash($_POST["password"],PASSWORD_DEFAULT)

            // Se comprueba si el usuario existe y si sus datos son válidos
            if(empty($_POST["email"]) || empty($_POST['password'])){
                echo "<p style='color:red;'>Debe rellenar todos los campos</p>";
                
            } elseif(isset($final["emailUsuario"])){
                if($final["passwordUsuario"] == $password){
                    $_SESSION["email"] = $final["emailUsuario"];
                    header("Location: ../index.php");
                } else{
                    echo "<p style='color:red;'>El usuario o la contraseña no son correctos</p>";
                }
            } else{
                echo "<p style='color:red;'>El usuario o la contraseña no son correctos</p>";

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
    <link rel="stylesheet" href="../css/login.css">
    <title>Login</title>
</head>
<body>
<section class="vh-100" style="background-color: #272731; margin-top: 5em;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
            <div class="card" style="border-radius: 1rem;">
            <div class="row g-0">
                <div class="col-md-6 col-lg-5 d-none d-md-block">
                <img src="../img/personas.PNG" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem; margin-top: 6em;" />
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
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Email">
                    </div>

                    <div class="form-outline mb-4">
                        <label>Contraseña</label>
                        <input type="password" class="form-control" name="password" placeholder="Contraseña">
                    </div>

                    <div class="pt-1 mb-4">
                        <button type="submit" class="btn btn-secondary bg-dark" name="login">Iniciar sesión</button>
                        <a type="button" class="btn btn-secondary bg-dark" href="register.php">Registrarse</a>
                        <a type="button" class="btn btn-secondary" href="../index.php">Página principal</a>
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