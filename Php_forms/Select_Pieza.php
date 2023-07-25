<?php
    if(isset($_POST["noDiseno"])){
        $noDiseno = $_POST["noDiseno"];

            require_once("../conexionBD/Consultas.php");
            $miloraObj = MiloraClass::singleton();
            $data = $miloraObj->selectPieza($noDiseno);
            if(count($data)>0){
                foreach($data as $fila){
                 echo $fila["Descripcion_MP"].",".$fila["Codigo_MP"].","
                 .$fila["Corte"].",".$fila["Dobles"].",".$fila["Rolado"].",".$fila["Bisel"].",".$fila["Taladro"].",".$fila["Prensa"];
                }
            }else{
                echo "no";
            }
            
        
    }
?>