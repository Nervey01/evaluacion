<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['email']) && isset($_POST['numero_documento']) && isset($_POST['tipo_solicitud']) && isset($_POST['descripcion'])) {
        
        include 'conexion.php';

        
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
        $numero_documento = $_POST['numero_documento'];
        $tipo_solicitud = $_POST['tipo_solicitud'];
        $descripcion = $_POST['descripcion'];

        
        $sql = "INSERT INTO solicitudes_usuarios (nombre, apellido, email, numero_documento, solicitud, fecha_solicitud) VALUES ('$nombre', '$apellido', '$email', '$numero_documento', '$descripcion', NOW())";
        if ($conn->query($sql) === TRUE) {
            
            echo "Solicitud enviada exitosamente";
        } else {
            
            echo "Error al procesar la solicitud: " . $conn->error;
        }

        
        $conn->close();
    } else {
        
        echo "Por favor, complete todos los campos del formulario";
    }
} else {
    
    echo "Error: Método de solicitud incorrecto";
}
?>
