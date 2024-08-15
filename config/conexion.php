<?php
class ClaseConectar {
    private $host = "localhost"; 
    private $usuario = "root"; 
    private $password = ""; 
    private $base_datos = "gestion_cursos"; 

    public function ProcedimientoParaConectar() {
        $con = new mysqli($this->host, $this->usuario, $this->password, $this->base_datos);

        if ($con->connect_error) {
            die("Error en la conexión: " . $con->connect_error);
        }

        return $con;
    }
}
?>
