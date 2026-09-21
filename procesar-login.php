<?php
session_start();

$email = $_POST["email"];
$password = $_POST["password"];

if (empty($email) || empty($password)) {
    header("Location: login.php?error=campos");
    exit();
}

$conexion = mysqli_connect("localhost", "root", "", "cuidapp_db");

// Primero buscamos en la tabla de padres
$sql = "SELECT * FROM usuarios WHERE email = '$email'";
$resultado = mysqli_query($conexion, $sql);
$usuario = mysqli_fetch_assoc($resultado);

if ($usuario && password_verify($password, $usuario["password"])) {
    $_SESSION["usuario_id"] = (int)$usuario["ID"];
    $_SESSION["usuario_nombre"] = $usuario["nombre"];
    header("Location: dashboard-padre.php");
    exit();
}

// Si no es padre, buscamos en cuidadoras
$sql2 = "SELECT * FROM cuidadoras WHERE email = '$email'";
$resultado2 = mysqli_query($conexion, $sql2);
$cuidadora = mysqli_fetch_assoc($resultado2);

if ($cuidadora && password_verify($password, $cuidadora["password"])) {
    $_SESSION["cuidadora_id"] = (int)$cuidadora["id"];
    $_SESSION["cuidadora_nombre"] = $cuidadora["nombre"];
    header("Location: dashboard-cuidador.php");
    exit();
}

// Si no está en ninguna tabla
header("Location: login.php?error=credenciales");
exit();

mysqli_close($conexion);
?>