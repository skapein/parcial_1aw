<?php
// controllers/inscripciones.controller.php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Allow: GET, POST, PUT, DELETE");

require_once('../models/inscripciones.model.php');
$inscripciones = new Inscripciones();

$method = $_SERVER["REQUEST_METHOD"];
$op = isset($_GET["op"]) ? $_GET["op"] : "";

switch ($op) {
    case 'todos':
        $datos = $inscripciones->todos();
        $result = array();
        while ($row = mysqli_fetch_assoc($datos)) {
            $result[] = $row;
        }
        echo json_encode($result);
        break;
    
    case 'uno':
        $data = json_decode(file_get_contents('php://input'), true);
        $inscripcion_id = isset($data["inscripcion_id"]) ? $data["inscripcion_id"] : "";
        if (!empty($inscripcion_id)) {
            $datos = $inscripciones->uno($inscripcion_id);
            $res = mysqli_fetch_assoc($datos);
            echo json_encode($res);
        } else {
            echo json_encode(array("error" => "ID de inscripción no proporcionado."));
        }
        break;
    
    case 'insertar':
        $data = json_decode(file_get_contents('php://input'), true);
        $curso_id = isset($data["curso_id"]) ? $data["curso_id"] : "";
        $estudiante_id = isset($data["estudiante_id"]) ? $data["estudiante_id"] : "";
        $fecha_inscripcion = isset($data["fecha_inscripcion"]) ? $data["fecha_inscripcion"] : "";

        if (!empty($curso_id) && !empty($estudiante_id) && !empty($fecha_inscripcion)) {
            $datos = $inscripciones->insertar($curso_id, $estudiante_id, $fecha_inscripcion);
            echo json_encode(array("resultado" => $datos));
        } else {
            echo json_encode(array("error" => "Datos incompletos."));
        }
        break;
    
    case 'actualizar':
        $data = json_decode(file_get_contents('php://input'), true);
        $inscripcion_id = isset($data["inscripcion_id"]) ? $data["inscripcion_id"] : "";
        $curso_id = isset($data["curso_id"]) ? $data["curso_id"] : "";
        $estudiante_id = isset($data["estudiante_id"]) ? $data["estudiante_id"] : "";
        $fecha_inscripcion = isset($data["fecha_inscripcion"]) ? $data["fecha_inscripcion"] : "";

        if (!empty($inscripcion_id) && !empty($curso_id) && !empty($estudiante_id) && !empty($fecha_inscripcion)) {
            $datos = $inscripciones->actualizar($inscripcion_id, $curso_id, $estudiante_id, $fecha_inscripcion);
            echo json_encode(array("resultado" => $datos));
        } else {
            echo json_encode(array("error" => "Datos incompletos."));
        }
        break;
    
    case 'eliminar':
        $data = json_decode(file_get_contents('php://input'), true);
        $inscripcion_id = isset($data["inscripcion_id"]) ? $data["inscripcion_id"] : "";

        if (!empty($inscripcion_id)) {
            $datos = $inscripciones->eliminar($inscripcion_id);
            echo json_encode(array("resultado" => $datos));
        } else {
            echo json_encode(array("error" => "ID de inscripción no proporcionado."));
        }
        break;
}
?>
