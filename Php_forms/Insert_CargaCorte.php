<?php

    if(isset($_POST["Fecha"])){
        
        $fecha = $_POST["Fecha"];
        $fechalimite = $_POST["FechaLimite"];
        $turno = $_POST["Turno"];
        $operador = $_POST["Operador"];
        $maquina = $_POST["Maquina"];
        $no_orden = $_POST["No_orden"];
        $espesor = $_POST["Espesor"];
        $foliomp = $_POST["FolioMP"];
        $nestSolic = $_POST["NEST_solic"];
        $placasnest = $_POST["Placa_NEST"];

        try {
            require_once("../conexionBD/Consultas.php");
            $miloraObj = MiloraClass::singleton();
            $data = $miloraObj->CargaCorte($fecha, $fechalimite, $turno, $operador,$maquina, $no_orden, $espesor, $foliomp, $nestSolic, $placasnest);

            echo "si";
        } catch (\Throwable $th) {
            echo "no";
        }

    }

?>