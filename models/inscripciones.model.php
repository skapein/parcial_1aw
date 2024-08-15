<?php
require_once('../config/conexion.php');

class Inscripciones
{
    // Obtener todas las inscripciones
    public function todos()
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM inscripciones";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    // Obtener una inscripción por ID
    public function uno($inscripcion_id)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM inscripciones WHERE inscripcion_id = $inscripcion_id";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    // Insertar una nueva inscripción
    public function insertar($curso_id, $estudiante_id, $fecha_inscripcion)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO inscripciones (curso_id, estudiante_id, fecha_inscripcion) VALUES ('$curso_id', '$estudiante_id', '$fecha_inscripcion')";
            if (mysqli_query($con, $cadena)) {
                return $con->insert_id;
            } else {
                return $con->error;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        } finally {
            $con->close();
        }
    }

    // Actualizar una inscripción existente
    public function actualizar($inscripcion_id, $curso_id, $estudiante_id, $fecha_inscripcion)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE inscripciones SET curso_id = '$curso_id', estudiante_id = '$estudiante_id', fecha_inscripcion = '$fecha_inscripcion' WHERE inscripcion_id = $inscripcion_id";
            if (mysqli_query($con, $cadena)) {
                return $inscripcion_id;
            } else {
                return $con->error;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        } finally {
            $con->close();
        }
    }

    // Eliminar una inscripción
    public function eliminar($inscripcion_id)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM inscripciones WHERE inscripcion_id = $inscripcion_id";
            if (mysqli_query($con, $cadena)) {
                return 1; // Éxito
            } else {
                return $con->error;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        } finally {
            $con->close();
        }
    }
}
?>
