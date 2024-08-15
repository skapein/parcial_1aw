<?php
// models/inscripciones.model.php
require_once('../config/conexion.php');

class Inscripciones
{
    public function todos() // Obtener todas las inscripciones
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `inscripciones`";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function uno($inscripcion_id) // Obtener una inscripción por ID
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `inscripciones` WHERE `inscripcion_id`=$inscripcion_id";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function insertar($curso_id, $estudiante_id, $fecha_inscripcion) // Insertar una nueva inscripción
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `inscripciones` (`curso_id`, `estudiante_id`, `fecha_inscripcion`) VALUES ('$curso_id', '$estudiante_id', '$fecha_inscripcion')";
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

    public function actualizar($inscripcion_id, $curso_id, $estudiante_id, $fecha_inscripcion) // Actualizar una inscripción
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `inscripciones` SET `curso_id`='$curso_id', `estudiante_id`='$estudiante_id', `fecha_inscripcion`='$fecha_inscripcion' WHERE `inscripcion_id` = $inscripcion_id";
            if (mysqli_query($con, $cadena)) {
                return $inscripcion_id;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    public function eliminar($inscripcion_id) // Eliminar una inscripción
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `inscripciones` WHERE `inscripcion_id` = $inscripcion_id";
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
