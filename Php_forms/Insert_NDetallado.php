<?php
    if(isset($_POST["Fecha"])){
        $Estatus = $_POST["Estatus"];
        $fechaInicio = $_POST["Fecha"];
        $fechaLimite = $_POST["FechaLimite"];
        $Turno = $_POST["Turno"];
        $Operador = $_POST["Operador"];
        $TipoDetalle = $_POST["TipoDetallado"];
        $No_orden = $_POST["No_orden"];
        $NCantSol = $_POST["CantidadS"];
        try {
            require_once("../conexionBD/Consultas.php");
            $miloraObj = MiloraClass::singleton();
            $data = $miloraObj->Insertar_Detallado_Resago($Estatus, $fechaInicio, $fechaLimite, $Turno, $Operador, $TipoDetalle, $No_orden, $NCantSol);
            echo "si";
        } catch (\Throwable $th) {
            echo "no";
        }
    }
?>