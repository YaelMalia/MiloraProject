<?php

if(isset($_POST["disenoCount"])){
        
    $diseno = $_POST["disenoCount"];
    $orden = $_POST["ordenCount"];

    require_once("../conexionBD/Consultas.php");
    $miloraObj = MiloraClass::singleton();
    $data = $miloraObj->CountOrden($diseno, $orden);

    if(count($data)>0){
        foreach($data as $fila){
            echo $fila["Cantidad"];
        }
    }else{
        echo "notFound";
    }
}

?>