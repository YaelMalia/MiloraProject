<?php
    if(isset($_POST["ordenBuscar"])){
        $ordenB = $_POST["ordenBuscar"];
        $disenoB = $_POST["disenoBuscar"];

        require_once("../conexionBD/Consultas.php");
        $miloraObj = MiloraClass::singleton();
        $data = $miloraObj->Search_Orden_Editar($ordenB, $disenoB);

        if(count($data)>0){
            foreach($data as $fila){
                echo $fila["Fecha_limite"]. ",".$fila["Orden_compra"].",".$fila["No_diseno"].
                ",".$fila["Piezas_solicitadas"].",".$fila["Cliente"];
               }
        }else{
            echo "no";
        }
    }

?>