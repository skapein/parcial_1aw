<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}

// Requiere el modelo de cursos
require_once('../models/cursos.model.php');
error_reporting(0);
$cursos = new Cursos();

switch ($_GET["op"]) {
    case 'todos':
        // Obtener todos los cursos
        $datos = $cursos->todos();
        $result = array();
        while ($row = mysqli_fetch_assoc($datos)) {
            $result[] = $row;
        }
        echo json_encode($result);
        break;

    case 'uno':
        // Obtener un curso por ID
        $curso_id = $_POST["curso_id"];
        if (!empty($curso_id)) {
            $datos = $cursos->uno($curso_id);
            $res = mysqli_fetch_assoc($datos);
            echo json_encode($res);
        } else {
            echo json_encode(array("error" => "ID del curso no proporcionado."));
        }
        break;

    case 'insertar':
        // Insertar un nuevo curso
        $nombre = $_POST["nombre"];
        $descripcion = $_POST["descripcion"];
        $fecha_inicio = $_POST["fecha_inicio"];
        $fecha_fin = $_POST["fecha_fin"];

        if (!empty($nombre) && !empty($descripcion) && !empty($fecha_inicio) && !empty($fecha_fin)) {
            $datos = $cursos->insertar($nombre, $descripcion, $fecha_inicio, $fecha_fin);
            echo json_encode(array("resultado" => $datos));
        } else {
            echo json_encode(array("error" => "Datos incompletos."));
        }
        break;

    case 'actualizar':
        // Actualizar un curso existente
        $curso_id = $_POST["curso_id"];
        $nombre = $_POST["nombre"];
        $descripcion = $_POST["descripcion"];
        $fecha_inicio = $_POST["fecha_inicio"];
        $fecha_fin = $_POST["fecha_fin"];

        if (!empty($curso_id) && !empty($nombre) && !empty($descripcion) && !empty($fecha_inicio) && !empty($fecha_fin)) {
            $datos = $cursos->actualizar($curso_id, $nombre, $descripcion, $fecha_inicio, $fecha_fin);
            echo json_encode(array("resultado" => $datos));
        } else {
            echo json_encode(array("error" => "Datos incompletos."));
        }
        break;

    case 'eliminar':
        // Eliminar un curso por ID
        $curso_id = $_POST["curso_id"];
        if (!empty($curso_id)) {
            $datos = $cursos->eliminar($curso_id);
            echo json_encode(array("resultado" => $datos));
        } else {
            echo json_encode(array("error" => "ID del curso no proporcionado."));
        }
        break;

    default:
        echo json_encode(array("error" => "Operación no válida."));
        break;
}
?>
