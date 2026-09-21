<?php
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit();
}

$nombre = $_SESSION["usuario_nombre"];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
    <title>CUIDAPP — Buscar ahora</title>
</head>
<body>

<header>
    <h1>CUIDAPP</h1>
    <nav>
        <a href="dashboard-padre.php">← Volver</a>
        <a href="perfil-padre.php">Mi perfil</a>
        <a href="cerrar-sesion.php">Cerrar sesión</a>
    </nav>
</header>

<section>
    <h2>⚡ Lo necesito ahora</h2>
    <p>Canguro verificado en menos de 20 minutos. Radio de 10km.</p>

    <div class="card">
        <form action="procesar-urgencia.php" method="POST">
            <h3>¿Cuántas horas necesitas?</h3>
            <p>
                <select name="horas">
                    <option value="2">2 horas — 20€</option>
                    <option value="3">3 horas — 30€</option>
                    <option value="4">4 horas — 40€</option>
                    <option value="5">5 horas — 50€</option>
                    <option value="6">6 horas — 60€</option>
                    <option value="7">7 horas — 70€</option>
                    <option value="8">8 horas — 80€</option>
                </select>
            </p>

            <h3>Resumen</h3>
            <p>Precio: <strong>10€/hora</strong></p>
            <p>Suplemento desplazamiento: <strong>0€</strong></p>
            <p>Sin cancelación una vez aceptado.</p>

            <p>
                <button type="submit">Buscar canguro disponible ahora</button>
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