<?php
// Datos de conexión a la base de datos
$servername = "localhost"; // Cambia localhost por la dirección del servidor si es diferente
$username = "root"; // Cambia tu_usuario por el nombre de usuario de la base de datos
$password = ""; // Cambia tu_contraseña por la contraseña de la base de datos
$dbname = "solicitudes"; // Cambia SistemaGestionSolicitudes por el nombre de tu base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Establecer el conjunto de caracteres a UTF-8
$conn->set_charset("utf8");

// Si necesitas cerrar la conexión, puedes hacerlo así:
// $conn->close();
?>
