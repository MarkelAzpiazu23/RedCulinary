<?php
// Recibir los parámetros de la URL
$databaseName = $_GET['db'] ?? ''; // Nombre de la base de datos
$tableName = $_GET['table'] ?? '';   // Nombre de la tabla
$columns = array();                 // Columnas
$values = array();                  // Valores

// Recorrer los parámetros de la URL para obtener columnas y valores
foreach ($_GET as $parametro => $valor) {
    if ($parametro !== 'db' && $parametro !== 'table') {
        // Ignorar 'db' y 'table'
        $columns[] = $parametro;
        $values[] = $valor;
    }
}

// Comprobar que se proporcionaron suficientes columnas y valores
if (empty($databaseName) || empty($tableName) || empty($columns) || empty($values)) {
    echo "Error: No se proporcionaron suficientes datos.";
} else {
    // Realizar la conexión a la base de datos (debes proporcionar tus credenciales)
    $conn = new mysqli('localhost', 'root', '', 'euskultura');

    // Comprobar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Construir la consulta INSERT
    $columnNames = implode(', ', $columns);
    $columnValues = "'" . implode("', '", $values) . "'";
    $sql = "INSERT INTO $tableName ($columnNames) VALUES ($columnValues)";
    echo $sql."</br>";
    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
	    echo "<p>Inserción exitosa en la tabla $tableName.</p>";
	    echo "<script> setTimeout(function() {window.history.back();}, 2000);</script>";
    } else {
        echo "Error al insertar datos: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();

}
?>