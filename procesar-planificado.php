<?php
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION["usuario_id"];
$fecha = $_POST["fecha"];
$hora = $_POST["hora"];
$horas = (int)$_POST["horas"];
$radio = (int)$_POST["radio"];
$suplemento = $radio;
$total = ($horas * 10) + $suplemento;

$conexion = mysqli_connect("localhost", "root", "", "cuidapp_db");

// Buscar cuidadoras disponibles ese día
$dia_semana = strtolower(date('l', strtotime($fecha)));

// Traducir día al español
$dias_es = [
    'monday' => 'lunes',
    'tuesday' => 'martes',
    'wednesday' => 'miercoles',
    'thursday' => 'jueves',
    'friday' => 'viernes',
    'saturday' => 'sabado',
    'sunday' => 'domingo'
];

$dia_es = $dias_es[$dia_semana];

$sql = "SELECT * FROM cuidadoras 
        WHERE estado = 'disponible' 
        AND verificada = 1 
        AND dias_disponibles LIKE '%$dia_es%'
        AND hora_inicio <= '$hora'
        AND hora_fin >= '$hora'";

$resultado = mysqli_query($conexion, $sql);
$cuidadoras = [];
while ($c = mysqli_fetch_assoc($resultado)) {
    $cuidadoras[] = $c;
}

// Si no hay con filtro de horario, buscar todas las disponibles
if (count($cuidadoras) == 0) {
    $sql2 = "SELECT * FROM cuidadoras WHERE estado = 'disponible' AND verificada = 1";
    $resultado2 = mysqli_query($conexion, $sql2);
    while ($c = mysqli_fetch_assoc($resultado2)) {
        $cuidadoras[] = $c;
    }
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
        <a href="buscar-planificado.php">← Volver</a>
        <a href="cerrar-sesion.php">Cerrar sesión</a>
    </nav>
</header>

<section>
    <h2>📅 Canguros disponibles</h2>
    <p><?php echo count($cuidadoras); ?> cuidadoras disponibles.</p>

    <div class="card" style="margin-bottom:16px;">
        <p>Fecha: <strong><?php echo date('d/m/Y', strtotime($fecha)); ?></strong></p>
        <p>Hora: <strong><?php echo $hora; ?></strong></p>
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
            <a href="reserva-pago.php?cuidadora_id=<?php echo $cuidadora['id']; ?>&horas=<?php echo $horas; ?>&radio=<?php echo $radio; ?>&fecha=<?php echo $fecha; ?>&hora=<?php echo $hora; ?>&tipo=planificado"
               class="btn-grande btn-padre" style="margin-top:12px;">
                Reservar con <?php echo explode(' ', $cuidadora['nombre'])[0]; ?>
            </a>
        </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="card">
            <h3>Sin cuidadoras disponibles</h3>
            <p>No hay cuidadoras disponibles para esa fecha y hora.</p>
            <p>Prueba con otra fecha o amplía el radio de búsqueda.</p>
            <a href="buscar-planificado.php" class="btn-grande btn-cuidador" style="margin-top:12px;">
                Cambiar fecha
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