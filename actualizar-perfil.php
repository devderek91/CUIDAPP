<?php
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit();
}

$conexion = mysqli_connect("localhost", "root", "", "cuidapp_db");
$id = $_SESSION["usuario_id"];

$nombre = $_POST["nombre"];
$email = $_POST["email"];
$ciudad = $_POST["ciudad"];
$telefono = $_POST["telefono"];

$sql = "UPDATE usuarios SET 
        nombre = '$nombre',
        email = '$email',
        ciudad = '$ciudad',
        telefono = '$telefono'
        WHERE ID = " . $id;

if (mysqli_query($conexion, $sql)) {
    header("Location: perfil-padre.php?ok=1");
} else {
    header("Location: perfil-padre.php?error=1");
}

mysqli_close($conexion);
exit();
?>