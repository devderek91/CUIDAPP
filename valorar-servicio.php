<?php
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION["usuario_id"];
$cuidadora_id = isset($_GET['cuidadora_id']) ? (int)$_GET['cuidadora_id'] : 0;
$reserva_id = isset($_GET['reserva_id']) ? (int)$_GET['reserva_id'] : 0;

$conexion = mysqli_connect("localhost", "root", "", "cuidapp_db");

// Obtener datos de la cuidadora
$sql = "SELECT * FROM cuidadoras WHERE id = " . $cuidadora_id;
$resultado = mysqli_query($conexion, $sql);
$cuidadora = mysqli_fetch_assoc($resultado);

// Procesar valoración
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $puntuacion = $_POST["puntuacion"];
    $repetir = $_POST["repetir"];
    $comentario = $_POST["comentario"];

    $sql = "INSERT INTO valoraciones (usuario_id, cuidadora_id, reserva_id, puntuacion, repetir, comentario)
            VALUES ($usuario_id, $cuidadora_id, $reserva_id, $puntuacion, '$repetir', '$comentario')";

    if (mysqli_query($conexion, $sql)) {
        header("Location: dashboard-padre.php?valoracion=ok");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
    <title>CUIDAPP — Valorar servicio</title>
</head>
<body>

<header>
    <h1>CUIDAPP</h1>
    <a href="dashboard-padre.php">← Volver</a>
</header>

<section>
    <h2>¿Cómo fue el servicio?</h2>
    <p>Tu valoración ayuda a otros padres a elegir con confianza.</p>

    <?php if ($cuidadora): ?>
    <div class="card">
        <div class="perfil-header">
            <img src="<?php echo $cuidadora['foto'] ? $cuidadora['foto'] : 'https://via.placeholder.com/80'; ?>"
                 alt="Foto de <?php echo $cuidadora['nombre']; ?>"
                 class="perfil-foto">
            <div class="perfil-info">
                <h3><?php echo $cuidadora['nombre']; ?></h3>
                <p><?php echo $cuidadora['ciudad']; ?></p>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="card">
        <form action="valorar-servicio.php?cuidadora_id=<?php echo $cuidadora_id; ?>&reserva_id=<?php echo $reserva_id; ?>" method="POST">

            <h3>Puntuación general</h3>
            <p><label><input type="radio" name="puntuacion" value="5"> ⭐⭐⭐⭐⭐ Excelente</label></p>
            <p><label><input type="radio" name="puntuacion" value="4"> ⭐⭐⭐⭐ Muy bueno</label></p>
            <p><label><input type="radio" name="puntuacion" value="3"> ⭐⭐⭐ Bueno</label></p>
            <p><label><input type="radio" name="puntuacion" value="2"> ⭐⭐ Regular</label></p>
            <p><label><input type="radio" name="puntuacion" value="1"> ⭐ Malo</label></p>

            <h3>¿Repetirías con ella?</h3>
            <p><label><input type="radio" name="repetir" value="si"> Sí, la añado a favoritos</label></p>
            <p><label><input type="radio" name="repetir" value="no"> No</label></p>

            <h3>Cuéntanos más</h3>
            <p>
                <textarea name="comentario" placeholder="¿Qué destacarías del servicio?" maxlength="300"></textarea>
            </p>

            <p>
                <button type="submit">Enviar valoración</button>
            </p>

        </form>
    </div>
</section>

<footer>
    <p>CUIDAPP © 2026 — Barcelona</p>
</footer>

<script src="script.js"></script>
</body>
</html>