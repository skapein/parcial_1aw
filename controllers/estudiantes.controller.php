<?php
// Archivo: controllers/estudiantes.controller.php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}

require_once('../models/estudiantes.model.php');
error_reporting(0);

$estudiantes = new Estudiantes;

switch ($_GET["op"]) {
    case 'todos': // Obtener todos los estudiantes
        $datos = array();
        $datos = $estudiantes->todos();
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'uno': // Obtener un estudiante por ID
        if (isset($_POST["estudiante_id"])) {
            $estudiante_id = $_POST["estudiante_id"];
            $datos = $estudiantes->uno($estudiante_id);
            $res = mysqli_fetch_assoc($datos);
            echo json_encode($res);
        } else {
            echo json_encode(array("error" => "ID del estudiante no proporcionado."));
        }
        break;

    case 'insertar': // Insertar un nuevo estudiante
        if (isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["email"]) && isset($_POST["fecha_nacimiento"])) {
            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $email = $_POST["email"];
            $fecha_nacimiento = $_POST["fecha_nacimiento"];
            $datos = $estudiantes->insertar($nombre, $apellido, $email, $fecha_nacimiento);
            echo json_encode(array("resultado" => $datos));
        } else {
            echo json_encode(array("error" => "Datos incompletos."));
        }
        break;

    case 'actualizar': // Actualizar un estudiante
        if (isset($_POST["estudiante_id"]) && isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["email"]) && isset($_POST["fecha_nacimiento"])) {
            $estudiante_id = $_POST["estudiante_id"];
            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $email = $_POST["email"];
            $fecha_nacimiento = $_POST["fecha_nacimiento"];
            $datos = $estudiantes->actualizar($estudiante_id, $nombre, $apellido, $email, $fecha_nacimiento);
            echo json_encode(array("resultado" => $datos));
        } else {
            echo json_encode(array("error" => "Datos incompletos."));
        }
        break;

    case 'eliminar': // Eliminar un estudiante
        if (isset($_POST["estudiante_id"])) {
            $estudiante_id = $_POST["estudiante_id"];
            $datos = $estudiantes->eliminar($estudiante_id);
            echo json_encode(array("resultado" => $datos));
        } else {
            echo json_encode(array("error" => "ID del estudiante no proporcionado."));
        }
        break;

    default:
        echo json_encode(array("error" => "Operación no válida."));
        break;
}
?>
