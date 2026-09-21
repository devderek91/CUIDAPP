<?php
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION["usuario_id"];
$cuidadora_id = isset($_GET['cuidadora_id']) ? (int)$_GET['cuidadora_id'] : 0;

$conexion = mysqli_connect("localhost", "root", "", "cuidapp_db");

$sql = "SELECT * FROM cuidadoras WHERE id = " . $cuidadora_id;
$resultado = mysqli_query($conexion, $sql);
$cuidadora = mysqli_fetch_assoc($resultado);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
    <title>CUIDAPP — Reserva y pago</title>
</head>
<body>

<header>
    <h1>CUIDAPP</h1>
    <a href="dashboard-padre.php">← Volver</a>
</header>

<section>
    <h2>Confirmar reserva</h2>
    <p>Revisa los detalles antes de pagar.</p>

    <?php if ($cuidadora): ?>
    <div class="card">
        <div class="perfil-header">
            <img src="<?php echo $cuidadora['foto'] ? $cuidadora['foto'] : 'https://via.placeholder.com/80'; ?>"
                 alt="<?php echo $cuidadora['nombre']; ?>"
                 class="perfil-foto">
            <div class="perfil-info">
                <h3><?php echo $cuidadora['nombre']; ?></h3>
                <p><?php echo $cuidadora['ciudad']; ?><?php echo $cuidadora['zona'] ? ' — ' . $cuidadora['zona'] : ''; ?></p>
                <p><?php echo $cuidadora['precio']; ?>€/hora</p>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="card">
        <form action="procesar-reserva.php" method="POST">
            <input type="hidden" name="cuidadora_id" value="<?php echo $cuidadora_id; ?>">

            <h3>Detalles del servicio</h3>
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
                <select name="horas" id="horas" onchange="actualizarTotal()">
                    <option value="2">2 horas</option>
                    <option value="3">3 horas</option>
                    <option value="4">4 horas</option>
                    <option value="5">5 horas</option>
                    <option value="6">6 horas</option>
                    <option value="7">7 horas</option>
                    <option value="8">8 horas</option>
                </select>
            </p>

            <h3>Radio de búsqueda</h3>
            <p>
                <select name="radio" id="radioReserva" onchange="actualizarTotal()">
                    <option value="0">Hasta 10km — sin suplemento</option>
                    <option value="5">Hasta 30km — suplemento 5€</option>
                    <option value="10">Hasta 50km — suplemento 10€</option>
                </select>
            </p>

            <h3>Resumen del precio</h3>
            <p>Precio por hora: <strong><?php echo $cuidadora ? $cuidadora['precio'] : '10'; ?>€</strong></p>
            <p>Suplemento desplazamiento: <strong><span id="suplemento">0€</span></strong></p>
            <p>Total: <strong><span id="precioTotal">20€</span></strong></p>

            <h3>Método de pago</h3>
            <div class="card" style="background:#f5f9f7;">
                <p>💳 El pago se procesará de forma segura a través de <strong>Stripe</strong>.</p>
                <p>CUIDAPP nunca almacena datos de tu tarjeta.</p>
            </div>

            <h3>Política de cancelación</h3>
            <p>Cancelación gratuita hasta 24h antes.</p>
            <p>Entre 24h y 2h antes: 50% del servicio.</p>
            <p>Menos de 2h o modo urgencia: 100% del servicio.</p>

            <p>
                <button type="submit">Confirmar reserva — <span id="botonTotal">20€</span></button>
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