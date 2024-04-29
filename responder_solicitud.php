<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['solicitud_id']) && isset($_POST['respuesta'])) {
    $solicitud_id = $_POST['solicitud_id'];
    $respuesta = $_POST['respuesta'];

    
    $sql = "INSERT INTO respuestas (SolicitudID, Mensaje) VALUES ('$solicitud_id', '$respuesta')";
    if ($conn->query($sql) === TRUE) {
        
        $sql_update = "UPDATE solicitudes_usuarios SET estado = 2 WHERE id = '$solicitud_id'";
        if ($conn->query($sql_update) === TRUE) {
            echo "Respuesta enviada exitosamente";
        } else {
            echo "Error al actualizar el estado de la solicitud: " . $conn->error;
        }
    } else {
        echo "Error al enviar la respuesta: " . $conn->error;
    }
} else {
    header("Location: vista_gerente.php");
}
$conn->close();
?>
