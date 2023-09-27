<?php
    if(isset($_POST["Identificador"])){
        $Identificador = $_POST["Identificador"];
        $Nombre= $_POST["Nombre"];

        require_once("../conexionBD/Consultas_insumos.php");
        $miloraObj = InsumosClass::singleton();
        $data = $miloraObj->GetNoInsumo($Identificador,$Nombre);
        
        if(count($data)>0){
            foreach($data as $fila){
                echo $fila["Id_producto"];
            }
        }else{
            echo "notFound";
        }
    }

?>