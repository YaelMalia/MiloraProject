<?php
    if(isset($_POST["No_orden"])){
        $Norden = $_POST["No_orden"];
        $ProcActual = $_POST["ProcesoActual"];
        $Cantidad = $_POST["Cantidad"];
        $Estado_proc = $_POST["Estado_proceso"];
        $Proc_restantes = $_POST["Procesos_restantes"];
        $InicioFH = $_POST["Inicio"];

        try {
            require_once("../conexionBD/Consultas.php");
            $miloraObj = MiloraClass::singleton();
            $data = $miloraObj->Agregar_proceso($Norden, $ProcActual, $Cantidad, $Estado_proc, $Proc_restantes, $InicioFH);

            echo "si";
        } catch (\Throwable $th) {
            echo "no";
        }
    }
?>