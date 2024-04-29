<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Query SQL para obtener los tipos de solicitud
$sql = "SELECT id, nombre FROM tipo_solicitud";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Solicitud</title>
    <!-- CSS FILES -->                
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,400;0,700;1,200&family=Unbounded:wght@400;700&display=swap" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-icons.css" rel="stylesheet">
    <link href="css/tooplate-kool-form-pack.css" rel="stylesheet">
</head>
<body>
    <main>
        <section class="hero-section d-flex justify-content-center align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-12 mx-auto">
                        <form class="custom-form" role="form" method="post" action="procesar_solicitud.php">
                            <h2 class="hero-title text-center mb-4 pb-2">Nueva Solicitud</h2>
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="form-floating">
                                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre" required="">
                                        <label for="nombre">Nombre</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-floating">
                                        <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Apellido" required="">
                                        <label for="apellido">Apellido</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-floating">
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Correo electrónico" required="">
                                        <label for="email">Correo electrónico</label>
                                    </div>
                                </div>
                            
                                <div class="col-lg-6 col-12">
                                    <div class="form-floating">
                                        <input type="text" name="numero_documento" id="numero_documento" class="form-control" placeholder="Número de Documento" required="">
                                        <label for="numero_documento">Número de Documento</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-12">
                                    <div class="form-floating">
                                        <select name="tipo_solicitud" id="tipo_solicitud" class="form-control" required="">
                                            <option value="" disabled selected>Seleccionar Tipo de Solicitud</option>
                                            <?php
                                            // Generar las opciones del menú desplegable con los tipos de solicitud
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<option value='" . $row["id"] . "'>" . $row["nombre"] . "</option>";
                                                }
                                            } else {
                                                echo "<option value='' disabled>No hay tipos de solicitud disponibles</option>";
                                            }
                                            ?>
                                        </select>
                                        <label for="tipo_solicitud">Tipo de Solicitud</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-12">
                                    <div class="form-floating">
                                        <textarea name="descripcion" id="descripcion" class="form-control" placeholder="Descripción de la Solicitud" required=""></textarea>
                                        <label for="descripcion">Descripción de la Solicitud</label>
                                    </div>
                                </div>
                                <!-- Botón de enviar solicitud -->
                                <div class="row justify-content-center align-items-center">
                                    <div class="col-lg-5 col-md-5 col-5 ms-auto">
                                        <button type="submit" class="form-control">Enviar Solicitud</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- JAVASCRIPT FILES -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/countdown.js"></script>
    <script src="js/init.js"></script>
</body>
</html>
<?php
// Cerrar la conexión
$conn->close();
?>
