<?php
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit();
}

$conexion = mysqli_connect("localhost", "root", "", "cuidapp_db");

$nino_id = $_POST["nino_id"];
$nombre = $_POST["nombre"];
$edad = $_POST["edad"];
$alergias = $_POST["alergias"];
$medicamentos = $_POST["medicamentos"];
$telefono_emergencia = $_POST["telefono_emergencia"];
$gustos = $_POST["gustos"];
$miedos = $_POST["miedos"];
$rutina = $_POST["rutina"];
$observaciones = $_POST["observaciones"];

$sql = "UPDATE ninos SET 
        nombre = '$nombre',
        edad = '$edad',
        alergias = '$alergias',
        medicamentos = '$medicamentos',
        telefono_emergencia = '$telefono_emergencia',
        gustos = '$gustos',
        miedos = '$miedos',
        rutina = '$rutina',
        observaciones = '$observaciones'
        WHERE id = '$nino_id' AND usuario_id = " . $_SESSION["usuario_id"];

if (mysqli_query($conexion, $sql)) {
    header("Location: perfil-padre.php?ok=1");
} else {
    header("Location: perfil-padre.php?error=1");
}

mysqli_close($conexion);
exit();
?>