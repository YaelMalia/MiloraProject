<?php
    if(isset($_POST["disenoConsulta"])){
        
        $diseno = $_POST["disenoConsulta"];
        $orden = $_POST["ordenConsulta"];

        require_once("../conexionBD/Consultas.php");
        $miloraObj = MiloraClass::singleton();
        $data = $miloraObj->Get_noStock_Salidas($diseno, $orden);

        if(count($data)>0){
            foreach($data as $fila){
                echo $fila["cve_ai"];
            }
        }else{
            echo "notFound";
        }
    }

?>