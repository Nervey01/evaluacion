<?php
// Verificar si se recibieron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se recibieron todos los campos necesarios
    if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['email']) && isset($_POST['numero_documento']) && isset($_POST['tipo_solicitud']) && isset($_POST['descripcion'])) {
        // Incluir el archivo de conexión
        include 'conexion.php';

        // Obtener los datos del formulario
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
        $numero_documento = $_POST['numero_documento'];
        $tipo_solicitud = $_POST['tipo_solicitud'];
        $descripcion = $_POST['descripcion'];

        // Aquí puedes realizar cualquier validación adicional de los datos recibidos

        // Insertar los datos en la base de datos
        $sql = "INSERT INTO solicitudes_usuarios (nombre, apellido, email, numero_documento, solicitud, fecha_solicitud) VALUES ('$nombre', '$apellido', '$email', '$numero_documento', '$descripcion', NOW())";
        if ($conn->query($sql) === TRUE) {
            // Éxito al insertar los datos
            echo "Solicitud enviada exitosamente";
        } else {
            // Error al insertar los datos
            echo "Error al procesar la solicitud: " . $conn->error;
        }

        // Cerrar la conexión
        $conn->close();
    } else {
        // Faltan campos en el formulario
        echo "Por favor, complete todos los campos del formulario";
    }
} else {
    // Método de solicitud incorrecto
    echo "Error: Método de solicitud incorrecto";
}
?>
