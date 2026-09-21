<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
    <title>CUIDAPP — Registro cuidadora</title>
</head>
<body>

<header>
    <h1>CUIDAPP</h1>
    <a href="index.html">← Volver</a>
</header>

<section>
    <h2>Genera ingresos cuidando tu zona</h2>
    <p>Crea tu cuenta y empieza a generar ingresos extras.</p>

    <?php if (isset($_GET['error'])): ?>
        <p style="color:red;">Error — revisa los campos e inténtalo de nuevo.</p>
    <?php endif; ?>

    <form action="procesar-registro-cuidadora.php" method="POST" enctype="multipart/form-data">
        <p>
            <label>Nombre y Apellidos</label><br>
            <input type="text" name="nombre" placeholder="Tu nombre completo">
        </p>
        <p>
            <label>Email</label><br>
            <input type="email" name="email" placeholder="tu@email.com">
        </p>
        <p>
            <label>Contraseña</label><br>
            <input type="password" name="password" placeholder="Mínimo 8 caracteres">
        </p>
        <p>
            <label>Ciudad</label><br>
            <input type="text" name="ciudad" placeholder="Barcelona">
        </p>
        <p>
            <label>Teléfono</label><br>
            <input type="tel" name="telefono" placeholder="+34 600 000 000">
        </p>
        <p>
            <label>DNI — documento de identidad</label><br>
            <input type="file" name="dni">
        </p>
        <p>
            <label>Certificado de antecedentes penales</label><br>
            <input type="file" name="antecedentes">
        </p>
        <p>
            <label>Certificado de delitos de naturaleza sexual</label><br>
            <input type="file" name="delitos_sexuales">
        </p>
        <p>
            <button type="submit">Crear mi cuenta</button>
        </p>
    </form>
</section>

<footer>
    <p>
        <a href="aviso-legal.php">Aviso Legal</a> |
        <a href="politica-privacidad.php">Política de Privacidad</a> |
        <a href="politica-cookies.php">Política de Cookies</a>
    </p>
    <p>CUIDAPP © 2026 — Barcelona</p>
</footer>

</body>
</html>