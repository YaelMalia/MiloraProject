<?php
    if(isset($_POST["NoProcesoAct"])){
        $Nproc = $_POST["NoProcesoAct"];
        $EstadoProc = $_POST["Estado_proceso"];
        $PReal = $_POST["PRealizados"];
        $Prestantes = $_POST["Prestantes"];
        $TerminoFH = $_POST["TerminoFH"];

         try {
            require_once("../conexionBD/Consultas.php");
            $miloraObj = MiloraClass::singleton();
            $data = $miloraObj->Actualiza_ProcesoEstado($Nproc,$EstadoProc, $PReal, $Prestantes, $TerminoFH);
            echo "Si";
        } catch (\Throwable $th) {
            echo "No";
        }
    }
?>