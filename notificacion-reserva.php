<?php
session_start();

if (!isset($_SESSION["cuidadora_id"])) {
    header("Location: login.php");
    exit();
}

$cuidadora_id = $_SESSION["cuidadora_id"];
$reserva_id = isset($_GET['reserva_id']) ? (int)$_GET['reserva_id'] : 0;

$conexion = mysqli_connect("localhost", "root", "", "cuidapp_db");

// Aceptar o rechazar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accion = $_POST["accion"];
    if ($accion == "aceptar") {
        header("Location: servicio-activo.php?reserva_id=" . $reserva_id);
    } else {
        header("Location: dashboard-cuidador.php");
    }
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
    <title>CUIDAPP — Nueva reserva</title>
</head>
<body>

<header>
    <h1>CUIDAPP</h1>
    <a href="dashboard-cuidador.php">← Volver</a>
</header>

<section>

    <div class="card alerta-urgente">
        <div class="alerta-icon">⚡</div>
        <h2>Nueva solicitud de reserva</h2>
        <p>Tienes <span id="timer">15:00</span> para aceptar o rechazar.</p>
    </div>

    <div class="card">
        <h3>Detalles del servicio</h3>
        <p>📅 Fecha del servicio</p>
        <p>🕔 Horario y horas</p>
        <p>📍 Zona — distancia</p>
        <p>🚗 Suplemento desplazamiento: 0€</p>
        <p class="perfil-precio">Lo que cobrarás: —€</p>
    </div>

    <div class="card">
        <h3>Sobre el niño/a</h3>
        <p>Los datos del niño aparecerán aquí cuando el sistema de reservas esté activo.</p>
    </div>

    <div class="card">
        <h3>Familia</h3>
        <p>⭐ Padre/madre verificado</p>
    </div>

    <form method="POST">
        <input type="hidden" name="reserva_id" value="<?php echo $reserva_id; ?>">
        <div class="cards-row" style="margin-top:24px;">
            <button type="submit" name="accion" value="aceptar" class="btn-grande btn-padre">
                ✅ Aceptar reserva
            </button>
            <button type="submit" name="accion" value="rechazar" class="btn-grande btn-rechazar">
                ❌ Rechazar
            </button>
        </div>
    </form>

</section>

<footer>
    <p>CUIDAPP © 2026 — Barcelona</p>
</footer>

<script src="script.js"></script>
</body>
</html>