<?php
    if(isset($_POST["NoOrden"])){
        $Norden = $_POST["NoOrden"];
        $restantes = $_POST["Restantes"];

        try {
            require_once("../conexionBD/Consultas.php");
            $miloraObj = MiloraClass::singleton();
            $data = $miloraObj->Actualiza_Restantes($Norden, $restantes);
            echo "si";
        } catch (\Throwable $th) {
            echo "no";
        }
    }
?>