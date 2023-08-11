<?php
    if( (isset($_POST["FechaSa"])) || (isset($_POST["OrdenSa"])) || (isset($_POST["NoDisenoSa"]))){
        $fechaSa = $_POST["FechaSa"];
        $ordenSa = $_POST["OrdenSa"];
        $noDisenoSa = $_POST["NoDisenoSa"];

        require_once("../conexionBD/Consultas.php");
        $miloraObj = MiloraClass::singleton();
        $data = $miloraObj->GetSalidaFilter($fechaSa, $ordenSa, $noDisenoSa);
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