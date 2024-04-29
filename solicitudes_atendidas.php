<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}
include 'conexion.php';

// Obtener todas las solicitudes atendidas
$sql = "SELECT * FROM solicitudes_usuarios WHERE estado = 2 ORDER BY numero_documento ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Encabezado del HTML -->
</head>
<body>
    <h1>Bienvenido, <?php echo $_SESSION['username']; ?></h1>
    <h2>Solicitudes Atendidas</h2>
    <table>
        <thead>
            <tr>
                <th>Número de Documento</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Tipo de Solicitud</th>
                <th>Fecha de Solicitud</th>
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
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No hay solicitudes atendidas</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="descargar_solicitudes_atendidas.php">Descargar Excel</a>
    <br>
    <a href="cerrar_sesion.php">Cerrar Sesión</a>
</body>
</html>

<?php
$conn->close();
?>
