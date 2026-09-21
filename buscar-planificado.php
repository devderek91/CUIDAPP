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
    <title>CUIDAPP — Planificar servicio</title>
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
    <h2>📅 Modo planificado</h2>
    <p>Elige con tiempo tu canguro ideal. Hasta 50km de radio.</p>

    <div class="card">
        <form action="procesar-planificado.php" method="POST">

            <h3>¿Cuándo lo necesitas?</h3>
            <p>
                <label>Fecha</label><br>
                <input type="date" name="fecha">
            </p>
            <p>
                <label>Hora de inicio</label><br>
                <input type="time" name="hora">
            </p>
            <p>
                <label>Número de horas</label><br>
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

            <h3>¿Dónde?</h3>
            <p>
                <label>Radio de búsqueda</label><br>
                <select name="radio" id="radio" onchange="actualizarSuplemento()">
                    <option value="0">Hasta 10km — sin suplemento</option>
                    <option value="5">Hasta 30km — suplemento 5€</option>
                    <option value="10">Hasta 50km — suplemento 10€</option>
                </select>
                <p>Suplemento de desplazamiento: <span id="suplemento">0€</span></p>
            </p>

            <h3>¿Tienes alguna preferencia?</h3>
            <p><label><input type="checkbox" name="bebes"> Experiencia con bebés menores de 2 años</label></p>
            <p><label><input type="checkbox" name="especiales"> Experiencia con niños con necesidades especiales</label></p>
            <p><label><input type="checkbox" name="experiencia"> Más de 10 servicios realizados</label></p>
            <p><label><input type="checkbox" name="valoracion"> Valoración mínima de 4 estrellas</label></p>
            <p><label><input type="checkbox" name="catalan"> Habla catalán</label></p>
            <p><label><input type="checkbox" name="castellano"> Habla castellano</label></p>
            <p><label><input type="checkbox" name="ingles"> Habla inglés</label></p>

            <h3>Política de cancelación</h3>
            <p>Cancelación gratuita hasta 24h antes.</p>
            <p>Entre 24h y 2h antes: 50% del servicio.</p>
            <p>Menos de 2h antes: 100% del servicio.</p>

            <p>
                <button type="submit">Buscar canguro disponible</button>
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