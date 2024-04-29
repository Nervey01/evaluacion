<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $numero_documento = $_POST['numero_documento'];

    
    $sql = "SELECT Mensaje FROM respuestas WHERE SolicitudID IN (SELECT ID FROM solicitudes WHERE numero_documento = '$numero_documento')";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        
        $row = $result->fetch_assoc();
        $respuesta = $row['Mensaje'];
    } else {
        
        $respuesta = "No se encontró respuesta para el número de documento proporcionado.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Respuesta</title>
</head>
<body>
    <h1>Consulta de Respuesta del Gerente</h1>
    <form method="post">
        <label for="numero_documento">Ingrese su número de documento:</label><br>
        <input type="text" id="numero_documento" name="numero_documento" required><br><br>
        <input type="submit" value="Consultar">
    </form>

    <?php if (isset($respuesta)) : ?>
    <div>
        <h3>Respuesta del Gerente:</h3>
        <p><?php echo $respuesta; ?></p>
    </div>
    <?php endif; ?>
</body>
</html>

<?php
$conn->close();
?>
