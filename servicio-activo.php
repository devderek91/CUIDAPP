<?php
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION["usuario_id"];
$reserva_id = isset($_GET['reserva_id']) ? (int)$_GET['reserva_id'] : 0;

$conexion = mysqli_connect("localhost", "root", "", "cuidapp_db");

// Cargar mensajes
$sql_mensajes = "SELECT * FROM mensajes WHERE reserva_id = $reserva_id ORDER BY fecha ASC";
$resultado_mensajes = mysqli_query($conexion, $sql_mensajes);

// Enviar mensaje
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["mensaje"])) {
    $mensaje = $_POST["mensaje"];
    $sql = "INSERT INTO mensajes (reserva_id, emisor_tipo, emisor_id, mensaje)
            VALUES ($reserva_id, 'padre', $usuario_id, '$mensaje')";
    mysqli_query($conexion, $sql);
    header("Location: servicio-activo.php?reserva_id=" . $reserva_id);
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
    <title>CUIDAPP — Servicio en curso</title>
</head>
<body>

<header>
    <h1>CUIDAPP</h1>
    <p>🟢 Servicio en curso</p>
</header>

<section>

    <div class="card">
        <div class="alerta-icon">🟢</div>
        <h2>Todo bajo control</h2>
        <p>Servicio activo en curso</p>
        <p>⏱ Temporizador activo</p>
    </div>

    <div class="card">
        <h3>📍 Ubicación</h3>
        <p>Barcelona</p>
        <p style="font-size:13px;color:#999;">El mapa en tiempo real estará disponible en la versión app.</p>
    </div>

    <div class="card">
        <h3>💬 Chat</h3>
        <div id="mensajes">
            <?php if (mysqli_num_rows($resultado_mensajes) > 0): ?>
                <?php while ($msg = mysqli_fetch_assoc($resultado_mensajes)): ?>
                    <div class="chat-mensaje <?php echo $msg['emisor_tipo'] == 'padre' ? 'chat-padre' : 'chat-cuidador'; ?>">
                        <p><strong><?php echo $msg['emisor_tipo'] == 'padre' ? 'Tú' : 'Cuidadora'; ?></strong> — <?php echo date('H:i', strtotime($msg['fecha'])); ?></p>
                        <p><?php echo $msg['mensaje']; ?></p>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p style="color:#999;">Sin mensajes todavía.</p>
            <?php endif; ?>
        </div>

        <form action="servicio-activo.php?reserva_id=<?php echo $reserva_id; ?>" method="POST" style="margin-top:16px;display:flex;gap:8px;">
            <input type="text" name="mensaje" placeholder="Escribe un mensaje..." style="flex:1;">
            <button type="submit">Enviar</button>
        </form>
    </div>

    <div class="card">
        <h3>📞 Contacto de emergencia</h3>
        <a href="tel:+34600000000" class="btn-grande btn-padre">Llamar a la cuidadora</a>
    </div>

    <div class="card">
        <h3>¿Necesitas finalizar antes?</h3>
        <p style="font-size:13px;color:#999;">Se cobran las horas utilizadas redondeadas al alza. Mínimo 2 horas.</p>
        <a href="valorar-servicio.php?reserva_id=<?php echo $reserva_id; ?>" class="btn-grande btn-padre" style="margin-top:12px;">
            Finalizar servicio
        </a>
    </div>

</section>

<footer>
    <p>CUIDAPP © 2026 — Barcelona</p>
</footer>

<script src="script.js"></script>
</body>
</html>