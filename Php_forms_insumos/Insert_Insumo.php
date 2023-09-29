<?php
    if(isset($_POST["Identificador"])){
        $Identificador= $_POST["Identificador"];
        $Nombre= $_POST["Nombre"];
        $Descripcion= $_POST["Descripcion"];
        $Especificaciones= $_POST["Especificaciones"];
        $Categoria= $_POST["Categoria"];
        try {
            require_once("../conexionBD/Consultas_insumos.php");
            $miloraObj = InsumosClass::singleton();
            $data = $miloraObj->InsertarInsumo($Identificador, $Nombre, $Descripcion, $Especificaciones, $Categoria);
            echo "si";
        } catch (\Throwable $th) {
            echo "no";
        }
    }
?>