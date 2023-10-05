<?php
    if(isset($_POST["tipoVista"])){
        $vista = $_POST["tipoVista"];
        require_once("../conexionBD/Consultas_insumos.php");
        $miloraObj = InsumosClass::singleton();
        $data = $miloraObj->GetAllOrdenes();
        if(count($data)>0){
            if($vista == "Resumida"){
                foreach($data as $fila){
                    ?>

                    <?php
                }
            }else{
                foreach($data as $fila){   
                    ?>

                    <?php
                }
            }
        }else{
            echo "Nada";
        }
    }
?>