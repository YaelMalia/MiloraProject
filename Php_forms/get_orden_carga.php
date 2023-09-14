<?php
    if(isset($_POST["NoProc"])){
        $NoProc = $_POST["NoProc"];

        require_once("../conexionBD/Consultas.php");
        $miloraObj = MiloraClass::singleton();
        $data = $miloraObj->Get_noOrdenCarga($NoProc);

        if(count($data)>0){
            foreach($data as $fila){
                echo $fila["No_orden"];
            }
        }else{
            echo "Nada";
        }
    }
?>