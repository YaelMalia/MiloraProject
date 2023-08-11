<?php
    if(isset($_POST["tipoVista"])){
        $fechaEn = $_POST["FechaEn"];
        $ordenEn = $_POST["OrdenEn"];
        $noDisenoEn = $_POST["NoDisenoEn"];

        require_once("../conexionBD/Consultas.php");
        $miloraObj = MiloraClass::singleton();
        $data = $miloraObj->GetEntradaFilter($fechaEn, $ordenEn, $noDisenoEn);
        if(count($data)>0){
            ?>
                <tr>
                <td><?php echo $fila["Fecha_entrada"]; ?></td>
                <td><?php echo $fila["Orden_compra"]; ?></td>
                <td><?php echo $fila["No_diseno"]; ?></td>
                </tr>
                <?php
        }else{
            echo "Nada";
        }
    }
?>