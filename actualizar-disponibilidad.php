<?php
session_start();

if (!isset($_SESSION["cuidadora_id"])) {
    header("Location: login.php");
    exit();
}

$conexion = mysqli_connect("localhost", "root", "", "cuidapp_db");
$id = $_SESSION["cuidadora_id"];

$estado = $_POST["estado"];
$hora_inicio = $_POST["hora_inicio"];
$hora_fin = $_POST["hora_fin"];
$radio_km = $_POST["radio_km"];
$dias = isset($_POST["dias"]) ? implode(",", $_POST["dias"]) : "";

$sql = "UPDATE cuidadoras SET
        estado = '$estado',
        hora_inicio = '$hora_inicio',
        hora_fin = '$hora_fin',
        radio_km = '$radio_km',
        dias_disponibles = '$dias'
        WHERE id = " . $id;

if (mysqli_query($conexion, $sql)) {
    header("Location: dashboard-cuidador.php?ok=1");
} else {
    header("Location: gestion-disponibilidad.php?error=1");
}

mysqli_close($conexion);
exit();
?>