<?php
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION["usuario_id"];
$horas = (int)$_POST["horas"];
$radio = 0; // Modo urgencia — radio fijo 10km, sin suplemento
$suplemento = $radio;
$total = ($horas * 10) + $suplemento;

$conexion = mysqli_connect("localhost", "root", "", "cuidapp_db");

// Buscar cuidadoras disponibles
$sql = "SELECT * FROM cuidadoras WHERE estado = 'disponible' AND verificada = 1";
$resultado = mysqli_query($conexion, $sql);
$cuidadoras = [];
while ($c = mysqli_fetch_assoc($resultado)) {
    $cuidadoras[] = $c;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
    <title>CUIDAPP — Canguros disponibles</title>
</head>
<body>

<header>
    <h1>CUIDAPP</h1>
    <nav>
        <a href="buscar-urgencia.php">← Volver</a>
        <a href="cerrar-sesion.php">Cerrar sesión</a>
    </nav>
</header>

<section>
    <h2>⚡ Canguros disponibles ahora</h2>
    <p><?php echo count($cuidadoras); ?> cuidadoras cerca de ti.</p>

    <div class="card" style="margin-bottom:16px;">
        <p>Horas: <strong><?php echo $horas; ?>h</strong></p>
        <p>Suplemento desplazamiento: <strong><?php echo $suplemento; ?>€</strong></p>
        <p>Total estimado: <strong><?php echo $total; ?>€</strong></p>
    </div>

    <?php if (count($cuidadoras) > 0): ?>
        <?php foreach ($cuidadoras as $cuidadora): ?>
        <div class="card">
            <div class="perfil-header">
                <img src="<?php echo $cuidadora['foto'] ? $cuidadora['foto'] : 'https://via.placeholder.com/80'; ?>"
                     alt="<?php echo $cuidadora['nombre']; ?>"
                     class="perfil-foto">
                <div class="perfil-info">
                    <h3><?php echo $cuidadora['nombre']; ?></h3>
                    <p><?php echo $cuidadora['ciudad']; ?><?php echo $cuidadora['zona'] ? ' — ' . $cuidadora['zona'] : ''; ?></p>
                    <p><?php echo $cuidadora['precio']; ?>€/hora</p>
                    <?php if ($cuidadora['descripcion']): ?>
                        <p><?php echo $cuidadora['descripcion']; ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <a href="reserva-pago.php?cuidadora_id=<?php echo $cuidadora['id']; ?>&horas=<?php echo $horas; ?>&radio=<?php echo $radio; ?>&tipo=urgente"
               class="btn-grande btn-padre" style="margin-top:12px;">
                Reservar con <?php echo explode(' ', $cuidadora['nombre'])[0]; ?>
            </a>
        </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="card">
            <h3>Sin cuidadoras disponibles ahora mismo</h3>
            <p>No hay cuidadoras verificadas disponibles en este momento.</p>
            <p>Prueba el modo planificado para reservar con más tiempo.</p>
            <a href="buscar-planificado.php" class="btn-grande btn-cuidador" style="margin-top:12px;">
                Ir a modo planificado
            </a>
        </div>
    <?php endif; ?>

</section>

<footer>
    <p>CUIDAPP © 2026 — Barcelona</p>
</footer>

<script src="script.js"></script>
</body>
</html>