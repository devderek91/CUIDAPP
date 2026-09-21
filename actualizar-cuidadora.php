<?php
session_start();

if (!isset($_SESSION["cuidadora_id"])) {
    header("Location: login-cuidador.php");
    exit();
}

$conexion = mysqli_connect("localhost", "root", "", "cuidapp_db");
$id = $_SESSION["cuidadora_id"];

$nombre = $_POST["nombre"];
$email = $_POST["email"];
$ciudad = $_POST["ciudad"];
$zona = $_POST["zona"];
$telefono = $_POST["telefono"];
$precio = $_POST["precio"];
$descripcion = $_POST["descripcion"];
$experiencia = $_POST["experiencia"];

$sql = "UPDATE cuidadoras SET 
        nombre = '$nombre',
        email = '$email',
        ciudad = '$ciudad',
        zona = '$zona',
        telefono = '$telefono',
        precio = '$precio',
        descripcion = '$descripcion',
        experiencia = '$experiencia'
        WHERE id = " . $id;

if (mysqli_query($conexion, $sql)) {
    header("Location: dashboard-cuidador.php?ok=1");
} else {
    header("Location: perfil-cuidador.php?error=1");
}

mysqli_close($conexion);
exit();
?>