<?php
    if(isset($_POST["NoOrden"])){
        $Norden = $_POST["NoOrden"];
        $P_actual = $_POST["Pactual"];
        $Cantidad = $_POST["CantidadSP"];
        $Responsable = $_POST["Responsable"];
        $P_realizados = $_POST["PRealizados"];
        $EstadoP = $_POST["Estado_proceso"];
        $Prestantes = $_POST["PRestantes"];
        $InicioFH = $_POST["InicioFH"];

        try {
            require_once("../conexionBD/Consultas.php");
            $miloraObj = MiloraClass::singleton();
            $data = $miloraObj->NuevoProceso_Upd($Norden, $P_actual, $Cantidad, $Responsable, $P_realizados, $EstadoP, $Prestantes, $InicioFH);
            echo "Si";
        } catch (\Throwable $th) {
            echo "No";
        }
    }
?>