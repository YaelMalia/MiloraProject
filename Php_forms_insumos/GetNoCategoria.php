<?php
    if(isset($_POST["TipoCate"])){
        $Categoria = $_POST["TipoCate"];

        require_once("../conexionBD/Consultas_insumos.php");
        $miloraObj = InsumosClass::singleton();
        $data = $miloraObj->GetCategoria($Categoria);
        
        if(count($data)>0){
            foreach($data as $fila){
                echo $fila["Id_categoria"];
            }
        }else{
            echo "notFound";
        }
    }

?>