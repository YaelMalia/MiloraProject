<?php
    if(isset($_POST["Nombre"])){
        try {
            require_once("../conexionBD/Consultas_insumos.php");
            $miloraObj = MiloraClass::singleton();
            $data = $miloraObj->InsertarInsumo();

            echo "si";
        } catch (\Throwable $th) {
            echo "no";
        }
    }
?>