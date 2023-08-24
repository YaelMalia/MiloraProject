<?php
    if(isset($_POST["disenoC"])){
        $disenoBuscar = $_POST["disenoC"];
        $ordenBuscar = $_POST["ordenC"];

    try {
        require_once("../conexionBD/Consultas.php");
        $miloraObj = MiloraClass::singleton();
        $data = $miloraObj->Cerrar_Orden_Auto($disenoBuscar, $ordenBuscar);
        $data = $miloraObj->Cerrar_Stock($disenoBuscar, $ordenBuscar);
        echo "Hecho";
    } catch (\Throwable $th) {
        echo "Fail";
        echo $th;
    }
    }

?>