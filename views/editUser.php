<?php
    session_start();
    
    $resultado = [
        'error' => false 
    ];

    $config = include 'config.php';

    try{
        // Se conecta con la base de datos
        $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
        $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
        
        // Se coge el dni del usuario que se acaba de seleccionar
        $dni = $_GET['dni'];
        $selectDNI = $conexion->prepare('SELECT * FROM usuario where dniUsuario=:dni');
        $selectDNI->bindParam("dni", $dni, PDO::PARAM_STR);
        $selectDNI->execute();
        $dniUsuario = $selectDNI->fetch();

    } catch(PDOException $error){
        $resultado['error'] = true;
    }
?>

<?php 
    include "../parts/header.php";

    if(isset($resultado)) {
    ?>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert- <?= $resultado['error'] ? 'danger' : 'success' ?>" role="alert">
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
            <h2 class="mt-4">Editar usuario</h2>
                <hr>
            <form method="post" action="guardarEdit.php">
                <div class="form-group">
                <input type="hidden" name="dni" value="<?php echo $_GET['dni']; ?>">
                    <label for="nombre">DNI</label>
                    <input type="text" class="form-control" name="dni" id="dni" value="<?php echo $dniUsuario['dniUsuario']; ?>">
                </div>
                <div class="form-group">
                    <label for="apellido">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" class="form-control" value="<?php echo $dniUsuario['nombreUsuario']; ?>">
                </div>
                <div class="form-group">
                    <label for="email">Apellidos</label>
                    <input type="text" class="form-control" name="apellidos" id="apellidos" class="form-control" value="<?php echo $dniUsuario['apellidosUsuario']; ?>">
                </div>
                <div class="form-group">
                    <label for= "edad">Email</label>
                    <input type="text" class="form-control" name="email" id="email" value="<?php echo $dniUsuario['emailUsuario']; ?>">
                </div>
                <div class="form-group">
                    <label for="email">Contraseña</label>
                    <input type="text" class="form-control" name="password" id="password" value="<?php echo $dniUsuario['passwordUsuario']; ?>">
                </div>
                <div class="form-group">
                    <input type="submit" name="actualizar" class="btn btn-secondary" value="Actualizar">
                    <a class="btn btn-secondary" href="../index.php">Volver al perfil</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../parts/footer.php' ?>