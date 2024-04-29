<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}
include 'conexion.php';

// Obtener todas las solicitudes no atendidas
$sql = "SELECT solicitudes_usuarios.*, respuestas.Mensaje AS respuesta 
        FROM solicitudes_usuarios 
        LEFT JOIN respuestas ON solicitudes_usuarios.id = respuestas.SolicitudID 
        WHERE solicitudes_usuarios.estado = 1 
        ORDER BY solicitudes_usuarios.fecha_solicitud ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Encabezado del HTML -->
</head>
<body>
    <h1>Bienvenido, <?php echo $_SESSION['username']; ?></h1>
    <h2>Solicitudes Pendientes</h2>
    <table>
        <thead>
            <tr>
                <th>Número de Documento</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Tipo de Solicitud</th>
                <th>Fecha de Solicitud</th>
                <th>Respuesta</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["numero_documento"] . "</td>";
                    echo "<td>" . $row["nombre"] . "</td>";
                    echo "<td>" . $row["apellido"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["solicitud"] . "</td>";
                    echo "<td>" . $row["fecha_solicitud"] . "</td>";
                    echo "<td>" . ($row["respuesta"] ? $row["respuesta"] : "Sin respuesta") . "</td>";
                    echo "<td>";
                    echo "<form action='responder_solicitud.php' method='post'>";
                    echo "<input type='hidden' name='solicitud_id' value='" . $row["id"] . "'>";
                    echo "<textarea name='respuesta' placeholder='Responder'></textarea>";
                    echo "<button type='submit'>Enviar</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No hay solicitudes pendientes</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="descargar_excel.php">Descargar Excel</a>
    <br>
    <a href="cerrar_sesion.php">Cerrar Sesión</a>
</body>
</html>

<?php
$conn->close();
?>
