<?php
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit();
}

$conexion = mysqli_connect("localhost", "root", "", "cuidapp_db");
$usuario_id = $_SESSION["usuario_id"];

$nombre = $_POST["nombre_nino"];
$edad = $_POST["edad"];
$alergias = $_POST["alergias"];
$notas = $_POST["notas"];

if (empty($nombre)) {
    header("Location: perfil-padre.php?error=nombre");
    exit();
}

$sql = "INSERT INTO ninos (usuario_id, nombre, edad, alergias, notas) 
        VALUES ($usuario_id, '$nombre', '$edad', '$alergias', '$notas')";

if (mysqli_query($conexion, $sql)) {
    header("Location: perfil-padre.php?hijo=ok");
} else {
    header("Location: perfil-padre.php?error=hijo");
}

mysqli_close($conexion);
exit();
?>
<footer>
    <p>
        <a href="aviso-legal.php">Aviso Legal</a> |
        <a href="politica-privacidad.php">Política de Privacidad</a> |
        <a href="politica-cookies.php">Política de Cookies</a>
    </p>
    <p>CUIDAPP © 2026 — Barcelona</p>
</footer>