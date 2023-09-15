<?php
    if(isset($_POST["NoReporte"])){
        
        $NoReporte = $_POST["NoReporte"];
        $Estatus = $_POST["Estatus"];
        $Cant_rep = $_POST["Cantidad_reportada"];
        $Placas_cort = $_POST["Placas_cortadas"];
        $HorasTrabajadas = $_POST["Horas_trabajadas"];
        $Observaciones = $_POST["Observaciones"];
        $PorcentajeCum = $_POST["Porcentaje_cum"];

        try {
            require_once("../conexionBD/Consultas.php");
            $miloraObj = MiloraClass::singleton();
            $data = $miloraObj->Actualiza_ReporteD($NoReporte, $Estatus, $Cant_rep, $Placas_cort, $HorasTrabajadas, $Observaciones, $PorcentajeCum);
            echo "Si";
        } catch (\Throwable $th) {
            echo "No";
        }
    }
?>