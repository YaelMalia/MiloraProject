<?php
    if(isset($_POST["ID_Orden"])){

        try {
            require_once("../conexionBD/Consultas.php");
            $miloraObj = MiloraClass::singleton();
            $data = $miloraObj->insert_orden($fechaInicio, $fechaLimite, $Orden ,$Cliente, $No_Dis, $CantidadP);

            echo "si";
        } catch (\Throwable $th) {
            echo "no";
        }
    }
?>