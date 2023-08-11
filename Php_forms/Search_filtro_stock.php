<?php
    if(isset($_POST["disenoBusqueda"]) || isset($_POST["estatusBusqueda"])){
        $disenoB = $_POST["disenoBusqueda"];
        $estatusB = $_POST["estatusBusqueda"];

        require_once("../conexionBD/Consultas.php");
        $miloraObj = MiloraClass::singleton();
        $data = $miloraObj->Stock_Filter($disenoB, $estatusB);

        if(count($data)>0){
            foreach($data as $fila){
                ?>
                <tr>
                <td><?php echo $fila["No_diseno"]; ?></td>
                <td><?php echo $fila["Orden_compra"]; ?></td>
                <td><?php echo $fila["Cantidad_actual"]; ?></td>
                <td><?php echo $fila["Estatus"]; ?></td>
                </tr>
            <?php
            }
        }else{
            echo "Nada";
        }

    }
?>