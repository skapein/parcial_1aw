<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}

require_once('../model/cursos.model.php');
error_reporting(0);
$cursos = new Cursos();

switch ($_GET["op"]) {
    case 'todos':
        $datos = array();
        $datos = $cursos->todos();
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'uno':
        $idCurso = isset($_POST["curso_id"]) ? $_POST["curso_id"] : null;
        if ($idCurso) {
            $datos = $cursos->uno($idCurso);
            $res = mysqli_fetch_assoc($datos);
            echo json_encode($res);
        } else {
            echo json_encode(["error" => "ID del curso no proporcionado."]);
        }
        break;

    case 'insertar':
        $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : null;
        $descripcion = isset($_POST["descripcion"]) ? $_POST["descripcion"] : null;
        $fecha_inicio = isset($_POST["fecha_inicio"]) ? $_POST["fecha_inicio"] : null;
        $fecha_fin = isset($_POST["fecha_fin"]) ? $_POST["fecha_fin"] : null;

        if ($nombre && $descripcion && $fecha_inicio && $fecha_fin) {
            $datos = $cursos->insertar($nombre, $descripcion, $fecha_inicio, $fecha_fin);
            echo json_encode(["resultado" => $datos]);
        } else {
            echo json_encode(["error" => "Datos incompletos."]);
        }
        break;

    case 'actualizar':
        $curso_id = isset($_POST["curso_id"]) ? $_POST["curso_id"] : null;
        $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : null;
        $descripcion = isset($_POST["descripcion"]) ? $_POST["descripcion"] : null;
        $fecha_inicio = isset($_POST["fecha_inicio"]) ? $_POST["fecha_inicio"] : null;
        $fecha_fin = isset($_POST["fecha_fin"]) ? $_POST["fecha_fin"] : null;

        if ($curso_id && $nombre && $descripcion && $fecha_inicio && $fecha_fin) {
            $datos = $cursos->actualizar($curso_id, $nombre, $descripcion, $fecha_inicio, $fecha_fin);
            echo json_encode(["resultado" => $datos]);
        } else {
            echo json_encode(["error" => "Datos incompletos."]);
        }
        break;

    case 'eliminar':
        $curso_id = isset($_POST["curso_id"]) ? $_POST["curso_id"] : null;
        if ($curso_id) {
            $datos = $cursos->eliminar($curso_id);
            echo json_encode(["resultado" => $datos]);
        } else {
            echo json_encode(["error" => "ID del curso no proporcionado."]);
        }
        break;
}
