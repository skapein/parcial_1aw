<?php
// Archivo: models/estudiante.model.php
require_once('../config/conexion.php');

class Estudiantes
{
    // Obtener todos los estudiantes
    public function todos() // select * from estudiantes
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `estudiantes`";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    // Obtener un estudiante por ID
    public function uno($estudiante_id) // select * from estudiantes where estudiante_id = $estudiante_id
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `estudiantes` WHERE `estudiante_id` = $estudiante_id";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    // Insertar un nuevo estudiante
    public function insertar($nombre, $apellido, $email, $fecha_nacimiento) // insert into estudiantes (nombre, apellido, email, fecha_nacimiento) values ($nombre, $apellido, $email, $fecha_nacimiento)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `estudiantes` (`nombre`, `apellido`, `email`, `fecha_nacimiento`) VALUES ('$nombre', '$apellido', '$email', '$fecha_nacimiento')";
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

    // Actualizar un estudiante existente
    public function actualizar($estudiante_id, $nombre, $apellido, $email, $fecha_nacimiento) // update estudiantes set nombre = $nombre, apellido = $apellido, email = $email, fecha_nacimiento = $fecha_nacimiento where estudiante_id = $estudiante_id
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `estudiantes` SET `nombre`='$nombre', `apellido`='$apellido', `email`='$email', `fecha_nacimiento`='$fecha_nacimiento' WHERE `estudiante_id` = $estudiante_id";
            if (mysqli_query($con, $cadena)) {
                return $estudiante_id;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    // Eliminar un estudiante
    public function eliminar($estudiante_id) // delete from estudiantes where estudiante_id = $estudiante_id
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `estudiantes` WHERE `estudiante_id` = $estudiante_id";
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
