<?php
    if( (isset($_POST["FechaEn"])) || (isset($_POST["OrdenEn"])) || (isset($_POST["NoDisenoEn"]))){
        $fechaEn = $_POST["FechaEn"];
        $ordenEn = $_POST["OrdenEn"];
        $noDisenoEn = $_POST["NoDisenoEn"];

        require_once("../conexionBD/Consultas.php");
        $miloraObj = MiloraClass::singleton();
        $data = $miloraObj->GetEntradaFilter($fechaEn, $ordenEn, $noDisenoEn);
        if(count($data)>0){
            foreach($data as $fila){
                ?>
                <tr>
                <td><?php echo $fila["Fecha_entrada"]; ?></td>
                <td><?php echo $fila["Orden_compra"]; ?></td>
                <td><?php echo $fila["No_diseno"]; ?></td>
                <td><?php echo $fila["Cantidad_entrada"]; ?></td>
                </tr>
            <?php
            }
        }else{
            echo "Nada";
        }
    }
?>