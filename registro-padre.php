<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="estilos.css">
    
    <title>CUIDAPP — Registro padre</title>
</head>
<body>

    <header>
        <h1>CUIDAPP</h1>
        <a href="index.html">← Volver</a>
    </header>

    <section>
        <h2>Busco a alguien de confianza para mis hijos</h2>
        <p>Crea tu cuenta y encuentra canguros verificados cerca de ti.</p>

        <form action="procesar-registro.php" method="POST">
    <p>
        <label>Nombre</label><br>
        <input type="text" name="nombre" placeholder="Tu nombre">
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
        <input type="text" name="ciudad" placeholder="">
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
<script src="script.js"></script>
</body>
</html>