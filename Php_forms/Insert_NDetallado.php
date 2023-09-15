<?php
    if(isset($_POST["Fecha"])){
        $fechaInicio = $_POST["Fecha"];
        $estatus= $_POST["Estatus"];
        $fechaLimite = $_POST["FechaLimite"];
        $Operador = $_POST["Operador"];
        $TipoDetalle = $_POST["TipoDetallado"];
        $No_orden = $_POST["No_orden"];
        $CantidadSoli = $_POST["CantidadSolicitada"];
        $observaciones= $_POST["Observaciones"];
        try {
            require_once("../conexionBD/Consultas.php");
            $miloraObj = MiloraClass::singleton();
            $data = $miloraObj->Insertar_Detallado_Resago($fechaInicio, $fechaLimite, $estatus, $Operador ,$TipoDetalle, $No_orden, $CantidadSoli);
            echo "si";
        } catch (\Throwable $th) {
            echo "no";
        }
    }
?>