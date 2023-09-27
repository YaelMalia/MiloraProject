<?php
    if(isset($_POST["Fecha"])){
        $Fecha= $_POST["Fecha"];
        $IdProd= $_POST["IdProd"];
        $Cantidad= $_POST["Cantidad"];
        try {
            require_once("../conexionBD/Consultas_insumos.php");
            $miloraObj = InsumosClass::singleton();
            $data = $miloraObj->InsertEntradaInsumo($Fecha, $IdProd, $Cantidad);
            echo "si";
        } catch (\Throwable $th) {
            echo "no";
        }
    }
?>