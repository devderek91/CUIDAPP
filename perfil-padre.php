<?php
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit();
}

$conexion = mysqli_connect("localhost", "root", "", "cuidapp_db");
$id = $_SESSION["usuario_id"];

$sql = "SELECT * FROM usuarios WHERE ID = " . $id;
$resultado = mysqli_query($conexion, $sql);
$usuario = mysqli_fetch_assoc($resultado);

$sql_ninos = "SELECT * FROM ninos WHERE usuario_id = " . $id;
$resultado_ninos = mysqli_query($conexion, $sql_ninos);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CUIDAPP — Mi perfil</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<header>
    <h1>CUIDAPP</h1>
    <nav>
        <a href="dashboard-padre.php">← Inicio</a>
        <a href="cerrar-sesion.php">Cerrar sesión</a>
    </nav>
</header>

<section id="perfil">

    <div class="card">
        <h2>Mis datos</h2>
        <?php if (isset($_GET['ok'])): ?>
            <p style="color:green;">✓ Cambios guardados correctamente.</p>
        <?php endif; ?>
        <form action="actualizar-perfil.php" method="POST">
            <p>
                <label>Nombre</label><br>
                <input type="text" name="nombre" value="<?php echo $usuario['nombre']; ?>">
            </p>
            <p>
                <label>Email</label><br>
                <input type="email" name="email" value="<?php echo $usuario['email']; ?>">
            </p>
            <p>
                <label>Ciudad</label><br>
                <input type="text" name="ciudad" value="<?php echo $usuario['ciudad']; ?>">
            </p>
            <p>
                <label>Teléfono</label><br>
                <input type="text" name="telefono" value="<?php echo $usuario['telefono']; ?>">
            </p>
            <p>
                <button type="submit">Guardar cambios</button>
            </p>
        </form>
    </div>

    <div class="card">
        <h2>Mis hijos</h2>

        <?php 
        $num_ninos = mysqli_num_rows($resultado_ninos);
        if ($num_ninos > 0): 
            while ($nino = mysqli_fetch_assoc($resultado_ninos)): ?>
            <div class="card">
                <h3><?php echo $nino['nombre']; ?> — <?php echo $nino['edad']; ?> años</h3>
                <form action="actualizar-nino.php" method="POST">
                    <input type="hidden" name="nino_id" value="<?php echo $nino['id']; ?>">
                    
                    <h4>Información básica</h4>
                    <p>
                        <label>Nombre</label><br>
                        <input type="text" name="nombre" value="<?php echo $nino['nombre']; ?>">
                    </p>
                    <p>
                        <label>Edad</label><br>
                        <input type="number" name="edad" value="<?php echo $nino['edad']; ?>" min="1" max="12">
                    </p>

                    <h4>Información de seguridad</h4>
                    <p>
                        <label>Alergias</label><br>
                        <input type="text" name="alergias" value="<?php echo $nino['alergias']; ?>" placeholder="Frutos secos, lactosa... o ninguna">
                    </p>
                    <p>
                        <label>Medicamentos</label><br>
                        <input type="text" name="medicamentos" value="<?php echo $nino['medicamentos']; ?>" placeholder="Nombre, dosis y horario... o ninguno">
                    </p>
                    <p>
                        <label>Teléfono de emergencia alternativo</label><br>
                        <input type="tel" name="telefono_emergencia" value="<?php echo $nino['telefono_emergencia']; ?>" placeholder="+34 600 000 000">
                    </p>

                    <h4>Información opcional</h4>
                    <p>
                        <label>Gustos y aficiones</label><br>
                        <input type="text" name="gustos" value="<?php echo $nino['gustos']; ?>" placeholder="Le encanta el fútbol, los dinosaurios...">
                    </p>
                    <p>
                        <label>Miedos o fobias</label><br>
                        <input type="text" name="miedos" value="<?php echo $nino['miedos']; ?>" placeholder="Oscuridad, perros...">
                    </p>
                    <p>
                        <label>Rutina habitual</label><br>
                        <input type="text" name="rutina" value="<?php echo $nino['rutina']; ?>" placeholder="Cena a las 20h, duerme a las 21h...">
                    </p>
                    <p>
                        <label>Observaciones adicionales</label><br>
                        <textarea name="observaciones" placeholder="Cualquier cosa importante que el cuidador deba saber..."><?php echo $nino['observaciones']; ?></textarea>
                    </p>
                    <p>
                        <button type="submit">Guardar cambios del niño</button>
                    </p>
                </form>
            </div>
        <?php endwhile;
        endif; ?>

        <?php if ($num_ninos < 2): ?>
        <h3>Añadir hijo/a</h3>
        <form action="añadir-nino.php" method="POST">
            <h4>Información básica</h4>
            <p>
                <label>Nombre</label><br>
                <input type="text" name="nombre_nino" placeholder="Nombre del niño/a">
            </p>
            <p>
                <label>Edad</label><br>
                <input type="number" name="edad" placeholder="Años" min="1" max="12">
            </p>

            <h4>Información de seguridad</h4>
            <p>
                <label>Alergias</label><br>
                <input type="text" name="alergias" placeholder="Frutos secos, lactosa... o ninguna">
            </p>
            <p>
                <label>Medicamentos</label><br>
                <input type="text" name="medicamentos" placeholder="Nombre, dosis y horario... o ninguno">
            </p>
            <p>
                <label>Teléfono de emergencia alternativo</label><br>
                <input type="tel" name="telefono_emergencia" placeholder="+34 600 000 000">
            </p>

            <h4>Información opcional</h4>
            <p>
                <label>Gustos y aficiones</label><br>
                <input type="text" name="gustos" placeholder="Le encanta el fútbol, los dinosaurios...">
            </p>
            <p>
                <label>Miedos o fobias</label><br>
                <input type="text" name="miedos" placeholder="Oscuridad, perros...">
            </p>
            <p>
                <label>Rutina habitual</label><br>
                <input type="text" name="rutina" placeholder="Cena a las 20h, duerme a las 21h...">
            </p>
            <p>
                <label>Observaciones adicionales</label><br>
                <textarea name="observaciones" placeholder="Cualquier cosa importante que el cuidador deba saber..."></textarea>
            </p>
            <p>
                <button type="submit">Añadir hijo/a</button>
            </p>
        </form>
        <?php endif; ?>
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