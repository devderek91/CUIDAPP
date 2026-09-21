<?php
session_start();

if (!isset($_SESSION["cuidadora_id"])) {
    header("Location: login-cuidador.php");
    exit();
}

$conexion = mysqli_connect("localhost", "root", "", "cuidapp_db");
$id = $_SESSION["cuidadora_id"];

$sql = "SELECT * FROM cuidadoras WHERE id = " . $id;
$resultado = mysqli_query($conexion, $sql);
$cuidadora = mysqli_fetch_assoc($resultado);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
    <title>CUIDAPP — Mi perfil</title>
</head>
<body>

<header>
    <h1>CUIDAPP</h1>
    <nav>
        <a href="dashboard-cuidador.php">← Inicio</a>
        <a href="cerrar-sesion-cuidador.php">Cerrar sesión</a>
    </nav>
</header>

<section id="perfil">

    <?php if (isset($_GET['ok'])): ?>
        <p style="color:green;">✓ Perfil actualizado correctamente.</p>
    <?php endif; ?>

    <div class="card">
        <h2>Mi perfil</h2>
        <form action="actualizar-cuidadora.php" method="POST">
            <p>
                <label>Nombre completo</label><br>
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
                <input type="text" name="zona" value="<?php echo $cuidadora['zona']; ?>" placeholder="Gracia, Eixample, Sarrià...">
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
                <textarea name="descripcion" placeholder="Cuéntales a los padres quién eres..."><?php echo $cuidadora['descripcion']; ?></textarea>
            </p>
            <p>
                <label>Experiencia</label><br>
                <textarea name="experiencia" placeholder="Años de experiencia, titulaciones, especialidades..."><?php echo $cuidadora['experiencia']; ?></textarea>
            </p>
            <p>
                <button type="submit">Guardar cambios</button>
            </p>
        </form>
    </div>

    <div class="card">
        <h3>Mis badges verificados</h3>
        <?php if ($cuidadora['verificada']): ?>
            <p>✓ Certificado de antecedentes penales</p>
            <p>✓ Certificado de delitos de naturaleza sexual</p>
            <p>✓ Documentación verificada por CUIDAPP</p>
        <?php else: ?>
            <p>⏳ Documentación pendiente de verificación.</p>
            <p>Tu perfil será visible cuando verifiquemos tus documentos.</p>
        <?php endif; ?>
    </div>

</section>

<footer>
    <p>CUIDAPP © 2026 — Barcelona</p>
</footer>

<script src="script.js"></script>
</body>
</html>