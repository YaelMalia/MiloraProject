<?php
    if(isset($_POST["disenoC"])){

        $disenoBuscar = $_POST["disenoC"];
        $ordenBuscar = $_POST["ordenC"];

        require_once("../conexionBD/Consultas.php");
        $miloraObj = MiloraClass::singleton();
        $data = $miloraObj->Cantidad_stock($disenoBuscar, $ordenBuscar);

        if(count($data)>0){
            foreach($data as $fila){
                echo $fila["Cantidad_actual"];
            }
        }else{
            echo "Nada";
        }
    }

?>