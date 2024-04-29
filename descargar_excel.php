<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}
include 'conexion.php';


$sql = "SELECT * FROM solicitudes_usuarios WHERE estado = 1 ORDER BY fecha_solicitud ASC";
$result = $conn->query($sql);


$filename = "solicitudes_pendientes_" . date('Y-m-d') . ".csv";
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $filename . '"');

$output = fopen('php://output', 'w');
fputcsv($output, array('Número de Documento', 'Nombre', 'Apellido', 'Email', 'Tipo de Solicitud', 'Fecha de Solicitud'));

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }
}

fclose($output);
$conn->close();
?>
