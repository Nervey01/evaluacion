<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Verificar si se enviaron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verificar si la contraseña cumple con el patrón alfanumérico de 10 caracteres
    if (!preg_match('/^[A-Za-z0-9]{10}$/', $password)) {
        // Contraseña no cumple con el formato esperado
        echo "La contraseña debe tener exactamente 10 caracteres alfanuméricos";
        exit; // Detener el script
    }

    // Consultar la base de datos para verificar las credenciales
    $sql = "SELECT * FROM Usuarios WHERE Username = '$username' AND Password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Las credenciales son válidas, iniciar sesión
        session_start();
        $_SESSION['username'] = $username; // Guardar el nombre de usuario en la sesión

        // Obtener el rol del usuario
        $row = $result->fetch_assoc();
        $rol = $row['Rol'];

        // Redirigir según el rol del usuario
        if ($rol == 'Gerente') {
            header("Location: vista_gerente.php"); // Redirige al dashboard del gerente
        } else {
            header("Location: vista_empleado.php"); // Redirige al dashboard del empleado
        }
    } else {
        // Las credenciales no son válidas, mostrar un mensaje de error
        echo "Nombre de usuario o contraseña incorrectos";
    }
} else {
    // Si no se enviaron datos del formulario, redirigir al formulario de inicio de sesión
    header("Location: login.html");
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
