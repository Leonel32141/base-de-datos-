<?php

$conexion = new mysqli("127.0.0.1", "root", "", "phising");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}


$usuario_ingresado = $_POST['usuario'];
$contrasena_plana = $_POST['contrasena'];

$contrasena_hasheada = password_hash($contrasena_plana, PASSWORD_DEFAULT);


$sql = "INSERT INTO usuarios (usuario, contrasena) VALUES (?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("ss", $usuario_ingresado, $contrasena_hasheada);

if ($stmt->execute()) {
    echo "¡Listo! El usuario se guardó correctamente.";
    echo "<br><br>Andá a phpMyAdmin, mirá la tabla 'usuarios' y vas a ver la contraseña convertida en un texto inentendible.";
} else {
    echo "Hubo un error: " . $conexion->error;
}
?>