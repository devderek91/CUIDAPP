<?php
session_start();

if (!isset($_SESSION["cuidadora_id"])) {
    header("Location: login.php");
    exit();
}

$conexion = mysqli_connect("localhost", "root", "", "cuidapp_db");
$id = $_SESSION["cuidadora_id"];

$sql = "SELECT * FROM cuidadoras WHERE id = " . $id;
$resultado = mysqli_query($conexion, $sql);
$cuidadora = mysqli_fetch_assoc($resultado);

$dias_guardados = $cuidadora['dias_disponibles'] ? explode(",", $cuidadora['dias_disponibles']) : [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
    <title>CUIDAPP — Mi disponibilidad</title>
</head>
<body>

<header>
    <h1>CUIDAPP</h1>
    <nav>
        <a href="dashboard-cuidador.php">← Inicio</a>
        <a href="cerrar-sesion-cuidador.php">Cerrar sesión</a>
    </nav>
</header>

<section>
    <h2>Mi disponibilidad</h2>
    <p>Indica cuándo puedes trabajar. Solo recibirás reservas en los horarios que marques.</p>

    <?php if (isset($_GET['ok'])): ?>
        <p style="color:green;">✓ Disponibilidad guardada correctamente.</p>
    <?php endif; ?>

    <div class="card">
        <form action="actualizar-disponibilidad.php" method="POST">

            <h3>Estado general</h3>
            <p>
                <label>
                    <input type="radio" name="estado" value="disponible"
                    <?php echo $cuidadora['estado'] == 'disponible' ? 'checked' : ''; ?>>
                    🟢 Disponible ahora
                </label>
            </p>
            <p>
                <label>
                    <input type="radio" name="estado" value="no_disponible"
                    <?php echo $cuidadora['estado'] == 'no_disponible' ? 'checked' : ''; ?>>
                    🔴 No disponible ahora
                </label>
            </p>

            <h3>Días disponibles</h3>
            <?php
            $dias = ['lunes','martes','miercoles','jueves','viernes','sabado','domingo'];
            $dias_nombres = ['Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo'];
            foreach ($dias as $i => $dia):
            ?>
            <p>
                <label>
                    <input type="checkbox" name="dias[]" value="<?php echo $dia; ?>"
                    <?php echo in_array($dia, $dias_guardados) ? 'checked' : ''; ?>>
                    <?php echo $dias_nombres[$i]; ?>
                </label>
            </p>
            <?php endforeach; ?>

            <h3>Franja horaria</h3>
            <p>
                <label>Desde</label><br>
                <input type="time" name="hora_inicio" value="<?php echo $cuidadora['hora_inicio']; ?>">
            </p>
            <p>
                <label>Hasta</label><br>
                <input type="time" name="hora_fin" value="<?php echo $cuidadora['hora_fin']; ?>">
            </p>

            <h3>Zona de trabajo</h3>
            <p>
                <label>Radio máximo de desplazamiento</label><br>
                <select name="radio_km">
                    <option value="10" <?php echo $cuidadora['radio_km'] == 10 ? 'selected' : ''; ?>>Hasta 10km — sin suplemento</option>
                    <option value="30" <?php echo $cuidadora['radio_km'] == 30 ? 'selected' : ''; ?>>Hasta 30km — suplemento 5€</option>
                    <option value="50" <?php echo $cuidadora['radio_km'] == 50 ? 'selected' : ''; ?>>Hasta 50km — suplemento 10€</option>
                </select>
            </p>

            <p>
                <button type="submit">Guardar disponibilidad</button>
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