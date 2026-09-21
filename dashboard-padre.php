<?php
session_start();
if (!isset($_SESSION["usuario_nombre"])) {
    header("Location: login.php");
    exit();
}

$nombre = $_SESSION["usuario_nombre"];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CUIDAPP — Inicio</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<header>
    <h1>CUIDAPP</h1>
    <nav>
        <a href="perfil-padre.php">Mi perfil</a>
        <a href="cerrar-sesion.php">Cerrar sesión</a>
    </nav>
</header>

<section id="dashboard">
    <h2>¡Has vuelto, <?php echo $nombre; ?>!</h2>
    <p>¿Qué necesitas hoy?</p>

    <div class="cards-row">
        <a href="buscar-urgencia.php" class="btn-grande btn-padre">
            <span class="card-icono">⚡</span>
            <h3>Modo urgencia</h3>
            <p>Canguro disponible en los próximos 60 minutos</p>
        </a>

        <a href="buscar-planificado.php" class="btn-grande btn-cuidador">
            <span class="card-icono">📅</span>
            <h3>Modo planificado</h3>
            <p>Elige con tiempo tu cuidador ideal</p>
        </a>
    </div>
</section>

<footer>
    <p>
        <a href="aviso-legal.php">Aviso Legal</a> |
        <a href="politica-privacidad.php">Política de Privacidad</a> |
        <a href="politica-cookies.php">Política de Cookies</a>
    </p>
    <p>CUIDAPP © 2026 — Barcelona</p>
</footer>
<script src="script.js"></script>
</body>
</html>