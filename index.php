<?php
/**
    * @author Sara Marrero Miranda
    * @version 1.0
    * @package General
    * @Date: 2023-01-31
    * @email: saramarreromiranda@gmail.com
    * @Github: https://github.com/SaraMarrero
 */
    session_start();
?>

<?php include "parts/header.php"; ?>
    <section style="margin-bottom: 2em;">
        <img src="img/fondo.png" style="width: 100%;">
    </section>

    <hr>

    <section style="text-align: center;">
        <h2>¿Qué quiere hacer?</h2>
        <a type="button" class="btn btn-secondary" href="views/publicarViaje.php">Publicar viaje</a>
        <a type="button" class="btn btn-secondary" href="views/verViajes.php">Ver viajes</a>
    </section>

    <hr>

    <section style="margin-bottom: 2em; display: flex; justify-content: space-evenly; flex-wrap: wrap; align-items: center;">
        <img src="img/fondo2.jpg" style="width: 70%;">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d388694.7243463881!2d-3.9597175647161436!3d40.43813877233032!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd422997800a3c81%3A0xc436dec1618c2269!2sMadrid!5e0!3m2!1ses!2ses!4v1674665563441!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section>

    <footer class="text-center text-white">
        <div class="text-center p-3  bg-dark">
            shareCar, 2023©
        </div>
    </footer>

<?php include "parts/footer.php"; ?>