<?php
    if(isset($_POST["Fecha"])){
        $fechaInicio = $_POST["Fecha"];
        $fechaLimite = $_POST["FechaLim"];
        $Operador = $_POST["Operador"];
        $TipoDetalle = $_POST["TipoDetallado"];
        $No_orden = $_POST["No_orden"];
        $CantidadSoli = $_POST["CantidadSolicitada"];
        try {
            require_once("../conexionBD/Consultas.php");
            $miloraObj = MiloraClass::singleton();
            $data = $miloraObj->Insertar_Proceso_Detallado($fechaInicio, $fechaLimite, $Operador ,$TipoDetalle, $No_orden, $CantidadSoli);

            echo "si";
        } catch (\Throwable $th) {
            echo "no";
        }
    }
?>