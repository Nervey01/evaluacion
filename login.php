<?php

include 'conexion.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    if (!preg_match('/^[A-Za-z0-9]{10}$/', $password)) {
        
        echo "La contraseña debe tener exactamente 10 caracteres alfanuméricos";
        exit; 
    }


    $sql = "SELECT * FROM Usuarios WHERE Username = '$username' AND Password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        
        session_start();
        $_SESSION['username'] = $username; 

        
        $row = $result->fetch_assoc();
        $rol = $row['Rol'];

        
        if ($rol == 'Gerente') {
            header("Location: vista_gerente.php"); 
        } else {
            header("Location: vista_empleado.php"); 
        }
    } else {
        
        echo "Nombre de usuario o contraseña incorrectos";
    }
} else {
    
    header("Location: login.html");
}


$conn->close();
?>
