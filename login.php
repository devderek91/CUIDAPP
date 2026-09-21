<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CUIDAPP — Iniciar sesión</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<header>
    <h1>CUIDAPP</h1>
    <a href="index.html">← Volver</a>
</header>

<section>
    <h2>Iniciar sesión</h2>
    <p>Accede a tu cuenta de CUIDAPP.</p>

    <form action="procesar-login.php" method="POST">
        <p>
            <label>Email</label><br>
            <input type="email" name="email" placeholder="tu@email.com">
        </p>
        <p>
            <label>Contraseña</label><br>
            <input type="password" name="password" placeholder="Tu contraseña">
        </p>
        <p>
            <button type="submit">Entrar</button>
        </p>
    </form>

    <p>¿No tienes cuenta? <a href="registro-padre.php">Regístrate aquí</a></p>
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
