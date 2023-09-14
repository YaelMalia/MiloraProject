<?php
    if(isset($_POST["ordenConsulta"])){
        $orden = $_POST["ordenConsulta"];
        $NoDiseno= $_POST["disenoConsulta"];

        require_once("../conexionBD/Consultas.php");
        $miloraObj = MiloraClass::singleton();
        $data = $miloraObj->Get_noOrden_Detallado($orden, $NoDiseno);

        if(count($data)>0){
            foreach($data as $fila){
                echo $fila["Numero_orden"];
            }
        }else{
            echo "notFound";
        }
    }

?>