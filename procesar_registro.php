<?php
header('Content-Type: application/json');

$nombre    = trim($_POST['nombre']    ?? '');
$apellidos = trim($_POST['apellidos'] ?? '');
$email     = trim($_POST['email']     ?? '');
$telefono  = trim($_POST['telefono']  ?? '');
$ciudad    = trim($_POST['ciudad']    ?? '');
$tipo      = trim($_POST['tipo']      ?? '');

$num_hijos    = trim($_POST['num_hijos']    ?? '');
$edades_hijos = trim($_POST['edades_hijos'] ?? '');
$necesidad    = trim($_POST['necesidad']    ?? '');

$experiencia    = trim($_POST['experiencia']    ?? '');
$disponibilidad = trim($_POST['disponibilidad'] ?? '');

$acepta_privacidad     = isset($_POST['acepta_privacidad'])     ? 1 : 0;
$acepta_comunicaciones = isset($_POST['acepta_comunicaciones']) ? 1 : 0;

$errores = [];

if (empty($nombre))    $errores[] = "El nombre es obligatorio.";
if (empty($apellidos)) $errores[] = "Los apellidos son obligatorios.";
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errores[] = "El email no es válido.";
if (empty($telefono))  $errores[] = "El teléfono es obligatorio.";
if (empty($ciudad))    $errores[] = "La ciudad es obligatoria.";
if (!in_array($tipo, ['padre', 'cuidadora'])) $errores[] = "Selecciona si eres padre/madre o cuidadora.";
if (!$acepta_privacidad) $errores[] = "Debes aceptar la Política de Privacidad.";

if (!empty($errores)) {
    echo json_encode(['ok' => false, 'errores' => $errores]);
    exit();
}

$conexion = new mysqli("localhost", "root", "", "cuidapp_db");

if ($conexion->connect_error) {
    echo json_encode(['ok' => false, 'error' => 'Error de conexión.']);
    exit();
}

$conexion->set_charset("utf8mb4");

$check = $conexion->prepare("SELECT id FROM lista_espera WHERE email = ?");
$check->bind_param("s", $email);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    echo json_encode(['ok' => false, 'error' => 'Este email ya está en la lista de espera.']);
    $check->close();
    $conexion->close();
    exit();
}
$check->close();

$stmt = $conexion->prepare(
    "INSERT INTO lista_espera 
     (nombre, apellidos, email, telefono, ciudad, tipo,
      num_hijos, edades_hijos, necesidad,
      experiencia, disponibilidad,
      acepta_privacidad, acepta_comunicaciones, fecha_registro)
     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())"
);

$stmt->bind_param(
    "sssssssssssii",
    $nombre, $apellidos, $email, $telefono, $ciudad, $tipo,
    $num_hijos, $edades_hijos, $necesidad,
    $experiencia, $disponibilidad,
    $acepta_privacidad, $acepta_comunicaciones
);

if ($stmt->execute()) {
    $mensaje = $tipo === 'padre'
        ? '¡Registro recibido! Te avisaremos cuando CUIDAPP esté lista.'
        : '¡Bienvenida a CUIDAPP! Revisaremos tu perfil y nos pondremos en contacto.';
    echo json_encode(['ok' => true, 'mensaje' => $mensaje]);
} else {
    echo json_encode(['ok' => false, 'error' => 'No se pudo guardar. Inténtalo de nuevo.']);
}

$stmt->close();
$conexion->close();
?>