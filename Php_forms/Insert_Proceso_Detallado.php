<?php
    if(isset($_POST["FechaFD"])){
        
        try {
            require_once("../conexionBD/Consultas.php");
            $miloraObj = MiloraClass::singleton();
            //$data = ;

            echo "si";
        } catch (\Throwable $th) {
            echo "no";
        }
    }
?>