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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["foto"]) && $_FILES["foto"]["error"] == 0) {
    $extension = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);
    $nombre_foto = "cuidadora_" . $id . "." . $extension;
    $ruta = "uploads/" . $nombre_foto;
    move_uploaded_file($_FILES["foto"]["tmp_name"], $ruta);
    mysqli_query($conexion, "UPDATE cuidadoras SET foto = '$ruta' WHERE id = $id");
    $cuidadora['foto'] = $ruta;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
    <title>CUIDAPP — Mi panel</title>
</head>
<body>

<header>
    <h1>CUIDAPP</h1>
    <nav>
        <a href="cerrar-sesion-cuidador.php">Cerrar sesión</a>
    </nav>
</header>

<section id="dashboard-cuidadora">

    <?php if (isset($_GET['ok'])): ?>
        <p style="color:green;">✓ Cambios guardados correctamente.</p>
    <?php endif; ?>

    <!-- FILA 1: FOTO + SALUDO -->
    <div class="card">
        <div class="perfil-header">
            <img src="<?php echo $cuidadora['foto'] ? $cuidadora['foto'] : 'https://via.placeholder.com/80'; ?>"
                 alt="Foto de perfil" class="perfil-foto">
            <div class="perfil-info">
                <h2>¡Hola, <?php echo $cuidadora['nombre']; ?>!</h2>
                <p><?php echo $cuidadora['ciudad']; ?><?php echo $cuidadora['zona'] ? ' — ' . $cuidadora['zona'] : ''; ?></p>
            </div>
        </div>
        <form action="dashboard-cuidador.php" method="POST" enctype="multipart/form-data">
            <p>
                <label>Cambiar foto de perfil</label><br>
                <input type="file" name="foto" accept="image/*">
            </p>
            <p><button type="submit">Subir foto</button></p>
        </form>
    </div>
<!-- FILA 2: ESTE MES + BADGES -->
    <div class="grid-2x2">
        <div class="card">
            <h3>Este mes</h3>
            <p>Servicios: <strong>0</strong></p>
            <p>Horas: <strong>0h</strong></p>
            <p>Ingresos: <strong>0€</strong></p>
        </div>

        <div class="card">
            <h3>Badges verificados</h3>
            <?php if ($cuidadora['verificada']): ?>
                <p>✓ Antecedentes penales</p>
                <p>✓ Delitos sexuales</p>
                <p>✓ Documentación verificada</p>
            <?php else: ?>
                <p>⏳ Pendiente de verificación</p>
                <p>Visible en 24-48h.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- FILA 3: RESERVAS -->
    <div class="card">
        <h3>Próximas reservas</h3>
        <p>No tienes reservas pendientes.</p>
    </div>

    <!-- FILA 4: MI ESTADO -->
    <div class="card">
        <h3>Mi estado y disponibilidad</h3>
        <form action="actualizar-disponibilidad.php" method="POST">
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

            <h4>Días disponibles</h4>
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

            <h4>Franja horaria</h4>
            <p>
                <label>Desde</label><br>
                <input type="time" name="hora_inicio" value="<?php echo $cuidadora['hora_inicio']; ?>">
            </p>
            <p>
                <label>Hasta</label><br>
                <input type="time" name="hora_fin" value="<?php echo $cuidadora['hora_fin']; ?>">
            </p>

            <h4>Radio de trabajo</h4>
            <select name="radio_km">
                <option value="10" <?php echo $cuidadora['radio_km'] == 10 ? 'selected' : ''; ?>>Hasta 10km</option>
                <option value="30" <?php echo $cuidadora['radio_km'] == 30 ? 'selected' : ''; ?>>Hasta 30km</option>
                <option value="50" <?php echo $cuidadora['radio_km'] == 50 ? 'selected' : ''; ?>>Hasta 50km</option>
            </select>

            <p><button type="submit">Guardar disponibilidad</button></p>
        </form>
    </div>

    <!-- FILA 5: MIS DATOS -->
    <div class="card">
        <h3>Mis datos</h3>
        <form action="actualizar-cuidadora.php" method="POST">
            <p>
                <label>Nombre</label><br>
                <input type="text" name="nombre" value="<?php echo $cuidadora['nombre']; ?>">
            </p>
            <p>
                <label>Email</label><br>
                <input type="email" name="email" value="<?php echo $cuidadora['email']; ?>">
            </p>
            <p>
                <label>Ciudad</label><br>
                <input type="text" name="ciudad" value="<?php echo $cuidadora['ciudad']; ?>">
            </p>
            <p>
                <label>Zona donde trabajas</label><br>
                <input type="text" name="zona" value="<?php echo $cuidadora['zona']; ?>" placeholder="Gracia, Eixample...">
            </p>
            <p>
                <label>Teléfono</label><br>
                <input type="tel" name="telefono" value="<?php echo $cuidadora['telefono']; ?>">
            </p>
            <p>
                <label>Precio por hora (€)</label><br>
                <input type="number" name="precio" value="<?php echo $cuidadora['precio']; ?>" min="10" max="20">
            </p>
            <p>
                <label>Sobre mí</label><br>
                <textarea name="descripcion"><?php echo $cuidadora['descripcion']; ?></textarea>
            </p>
            <p>
                <label>Experiencia</label><br>
                <textarea name="experiencia"><?php echo $cuidadora['experiencia']; ?></textarea>
            </p>
            <p><button type="submit">Guardar datos</button></p>
        </form>
    </div>