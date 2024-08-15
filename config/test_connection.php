<?php
require_once('conexion.php'); // Ruta correcta desde la misma carpeta

// Crear una instancia de la clase de conexión
$conexion = new ClaseConectar();

// Intentar realizar la conexión
$con = $conexion->ProcedimientoParaConectar();

// Verificar si la conexión fue exitosa
if ($con->connect_error) {
    die("Error en la conexión: " . $con->connect_error);
} else {
    echo "Conexión exitosa a la base de datos.";
}

// Cerrar la conexión
$con->close();
?>
