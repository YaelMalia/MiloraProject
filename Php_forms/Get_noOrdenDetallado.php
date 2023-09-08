<?php
    if(isset($_POST["NoDisenoFD"])){
        $orden = $_POST["NoDisenoFD"];

        require_once("../conexionBD/Consultas.php");
        $miloraObj = MiloraClass::singleton();
        $data = $miloraObj->Get_noOrden_Detallado($orden);

        if(count($data)>0){
            foreach($data as $fila){
                echo $fila["Numero_orden"];
            }
        }else{
            echo "notFound";
        }
    }

?>