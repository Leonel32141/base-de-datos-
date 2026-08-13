<?php

$conexion = new mysqli("127.0.0.1:3307", "root", "", "phising");

if ($conexion->connect_error) {
    die("Error de clave: " . $conexion->connect_error);
}


$usuario_ingresado = $_POST['usuario'];
$clave_plana = $_POST['clave'];

$clave_hasheada = password_hash($clave_plana, PASSWORD_DEFAULT);


$sql = "INSERT INTO usuarios (usuario, clave) VALUES (?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("ss", $usuario_ingresado, $clave_hasheada);

if ($stmt->execute()) {
    echo "¡Listo! El usuario se guardó correctamente.<br>";
    echo "ESTA ES TU CLAVE HASHEADA: " . htmlspecialchars($clave_hasheada) . " Y ESTA SIN HASHEAR: " . htmlspecialchars($clave_plana);
} else {
    echo "Hubo un error: " . $conexion->error;
}
?>
