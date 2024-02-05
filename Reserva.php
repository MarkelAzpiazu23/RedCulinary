<?php

// Verificar si se reciben los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Establecer conexión a la base de datos (ajusta los parámetros según tu configuración)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "red_culinary_sushi";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("La conexión a la base de datos falló: " . $conn->connect_error);
    }

    // Obtener valores del formulario
    $fecha = $_GET["fecha"];
    $hora = $_GET["hora"];
    $nombre = $_GET["nombre"];
    $apellidos = $_GET["apellidos"];
    $telefono = $_GET["telefono"];
    $correo = $_GET["correo"];
    $domicilio = $_GET["domicilio"];

    // Preparar la consulta SQL para la inserción
    $sql = "INSERT INTO reservas ( fecha, hora, nombre, apellidos, telefono, correo, domicilio)
            VALUES ( '$fecha', '$hora', '$nombre', '$apellidos', '$telefono', '$correo','$domicilio')";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        echo "Registro insertado correctamente";
    } else {
        echo "Error al insertar el registro: " . $conn->error;
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
}
?>