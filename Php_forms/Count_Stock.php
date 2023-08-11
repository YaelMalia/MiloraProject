<?php

    if(isset($_POST["where"])){
        require_once("../conexionBD/Consultas.php");
        $miloraObj = MiloraClass::singleton();
        $data = $miloraObj->Ordenar_Stock();

        if(count($data)>0){
            foreach($data as $fila){
                ?>
                <tr>
                <td><?php echo $fila["No_diseno"]; ?></td>
                <td><?php echo $fila["totalAlmacen"]; ?></td>
                <td><?php echo $fila["Estatus"]; ?></td>
                </tr>
            <?php
            }
        }else{
            echo "Nada";
        }
    }

?>