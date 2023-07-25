<?php
    if(isset($_POST["ID_Orden"])){
        $fechaInicio = $_POST["fechaInicio"];
        $fechaLimite = $_POST["fechaLimite"];
        $Orden = $_POST["ID_Orden"];
        $Cliente = $_POST["Cliente"];
        $No_Dis = $_POST["No_diseno"];
        $CantidadP = $_POST["CantidadPzs"];

        try {
            require_once("../conexionBD/Consultas.php");
            $miloraObj = MiloraClass::singleton();
            $data = $miloraObj->insert_orden($fechaInicio, $fechaLimite, $Orden,
        $Cliente, $No_Dis, $CantidadP);

            echo "si";
        } catch (\Throwable $th) {
            echo "no";
        }
    }
?>