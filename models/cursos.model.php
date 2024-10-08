<?php
// Archivo: models/cursos.model.php
require_once('../config/conexion.php');

class Cursos
{
    // Obtener todos los cursos
    public function todos() // select * from cursos
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `cursos`";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    // Obtener un curso por ID
    public function uno($curso_id) // select * from cursos where curso_id = $curso_id
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `cursos` WHERE `curso_id` = $curso_id";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    // Insertar un nuevo curso
    public function insertar($nombre, $descripcion, $fecha_inicio, $fecha_fin) // insert into cursos (nombre, descripcion, fecha_inicio, fecha_fin) values ($nombre, $descripcion, $fecha_inicio, $fecha_fin)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `cursos` (`nombre`, `descripcion`, `fecha_inicio`, `fecha_fin`) VALUES ('$nombre', '$descripcion', '$fecha_inicio', '$fecha_fin')";
            if (mysqli_query($con, $cadena)) {
                return $con->insert_id;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    // Actualizar un curso existente
    public function actualizar($curso_id, $nombre, $descripcion, $fecha_inicio, $fecha_fin) // update cursos set nombre = $nombre, descripcion = $descripcion, fecha_inicio = $fecha_inicio, fecha_fin = $fecha_fin where curso_id = $curso_id
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `cursos` SET `nombre`='$nombre', `descripcion`='$descripcion', `fecha_inicio`='$fecha_inicio', `fecha_fin`='$fecha_fin' WHERE `curso_id` = $curso_id";
            if (mysqli_query($con, $cadena)) {
                return $curso_id;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    // Eliminar un curso
    public function eliminar($curso_id) // delete from cursos where curso_id = $curso_id
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `cursos` WHERE `curso_id` = $curso_id";
            if (mysqli_query($con, $cadena)) {
                return 1;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }
}
?>
