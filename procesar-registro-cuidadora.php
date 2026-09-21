<?php
session_start();

$nombre = $_POST["nombre"];
$email = $_POST["email"];
$password = $_POST["password"];
$ciudad = $_POST["ciudad"];
$telefono = $_POST["telefono"];

if (empty($nombre) || empty($email) || empty($password)) {
    header("Location: registro-cuidador.php?error=campos");
    exit();
}

if (strlen($password) < 8) {
    header("Location: registro-cuidador.php?error=password");
    exit();
}

$conexion = mysqli_connect("localhost", "root", "", "cuidapp_db");

$password_segura = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO cuidadoras (nombre, email, password, ciudad, telefono) 
        VALUES ('$nombre', '$email', '$password_segura', '$ciudad', '$telefono')";

if (mysqli_query($conexion, $sql)) {
    $id = mysqli_insert_id($conexion);
    $_SESSION["cuidadora_id"] = $id;
    $_SESSION["cuidadora_nombre"] = $nombre;
    header("Location: dashboard-cuidador.php");
    exit();
} else {
header("Location: registro-cuidador.php?error=1");
exit();
}

mysqli_close($conexion);
?>